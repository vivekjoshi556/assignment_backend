<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Seat;
use App\Models\Coach;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\BookingRequest;

class BookingController extends Controller
{
    private $maxBookings = 7;

    /**
     * Get the data about the seat structure.
     * 
     * @return JSON response
     */
    public function getSeats() {
        Log::debug("Getting Sitting Arrangement: " . request()->ip());
        $result["arrangement"] = DB::table("coaches")
            ->select("row", "seats as total", "left")
            ->orderBy("id", "asc")
            ->get()
            ->toJson();

        return response()->json($result);
    }

    /**
     * Get the bookings of the current user.
     * 
     * @return JSON response
     */
    public function getBookings() {
        Log::debug("Getting Bookings from IP: " . request()->ip());
        $result = DB::table("bookings")
            ->select("seats")
            ->where("ip", request()->ip())
            ->first();

        if(!$result) return response()->json([]);

        return response()->json($result->seats);
    }

    /**
     * Books Seats for Users.
     * 
     * @param Request $request
     * 
     * @return JSON response
     */
    public function bookSeats(BookingRequest $request) {
        Log::debug("Bookings Seat: " . request()->ip());
        $required = $request->get('num_seats');
        try {
            DB::beginTransaction();
            if($required > $this->maxBookings)
                throw(new Exception("Single User Cannot Book more than " . $this->maxBookings . " seats"));

            $totalRemainingSeats = Coach::sum("left");
            if($totalRemainingSeats < $required)
                throw(new Exception("Sorry for Inconvenience. We don't have enough seats available right now."));

            $userBookings = Booking::where("ip", request()->ip())->first();
            if(!$userBookings) {
                $userBookings = Booking::create([
                    "ip" => request()->ip(),
                    "seats" => json_encode([])
                ]);
            }

            $bookings = json_decode($userBookings["seats"], true);

            $result = DB::table("coaches")
                ->select("id", "left", "row as row_id")
                ->where("left", ">", 0)
                ->orderBy("left", "asc")
                ->orderBy("row", "desc")
                ->get()->toArray();
            
            $len = count($result);
            $max = $result[$len - 1];
            $min = $result[0];
            
            if($max->left < $required) {
                // All the seats cannot be booked in same row.

                // Get Seats Left row wise in given coach.
                $rows = DB::table("coaches")
                    ->select("id", "left", "row as row_id")
                    ->where("left", ">", 0)
                    ->get()->toArray();

                $start = 0;
                $currStart = 0;
                $currCount = 0;
                $total = 0;
                $len = PHP_INT_MAX;

                // Iterate over all the rows to find the required seats that are closest.
                foreach($rows as $i => $row) {
                    $currCount += $row->left;
                    $total += $row->left;
                    while($currCount >= $required) {
                        if($len > $row->row_id - $rows[$currStart]->row_id + 1) {
                            $len = $row->row_id - $rows[$currStart]->row_id + 1;
                            $start = $currStart;
                        }
                        $currCount -= $rows[$currStart]->left;
                        $currStart += 1;
                    }
                }

                // Allot the seats from selected rows.
                for($i = $start; $i < $start + $len && $required; $i++) {
                    $idx = $rows[$i];
                    $take = min($required, $idx->left);
                    $required -= $take;
                    $bookings[$idx->row_id] = (key_exists($idx->row_id, $bookings)) ? array_merge($bookings[$idx->row_id], $this->confirmBookings($idx, $take)) : $this->confirmBookings($idx, $take);
                }
            }
            else {
                // If all the seats are available in a single row.
                if($max->left == $required) $idx = $max;
                else if($min->left >= $required) $idx = $min;
                // Otherwise find the row which is best for given number of passengers.
                else $idx = $result[$this->upperBound($result, $len, $required)];
                
                $bookings[$idx->row_id] = (key_exists($idx->row_id, $bookings)) ? array_merge($bookings[$idx->row_id], $this->confirmBookings($idx, $required)) : $this->confirmBookings($idx, $required);
            }

            $userBookings["seats"] = json_encode($bookings);
            $userBookings->save();

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                "status" => "error", 
                "message" => $e->getMessage()
            ]);
        }

        DB::commit();
        return response()->json([
            "status" => "success",
            "seats" => $bookings
        ]);
    }

    /**
     * Confirm Bookings in Update Tables.
     * 
     * @param Object $idx - Contains a row_id, number of remaining seats in that row, 
     * @param int $required - Represent the number of sets to book in given row.
     * 
     * @return array $seats - Returns the seats booked in this row.
     */
    private function confirmBookings($idx, $required) 
    {
        // Update the number of left seats in this row.
        Coach::where('id', $idx->id)
            ->update(['left' => $idx->left - $required]);
        
        DB::beginTransaction();

        // Get seat id's of seats to be booked.
        $seats = Seat::where('status', "0")
            ->where('row_id', $idx->row_id)
            ->limit($required)
            ->pluck("id")
            ->toArray();

        // Update the status of selected seats to booked.
        Seat::whereIn("id", $seats)
            ->update(['status' => "1"]);
        
        DB::commit();

        return $seats;
    }

    /**
     * Find the row which best fits the given number of passengers in one row.
     * In best fit if we need 2 seats and there are 2 rows with 3 & 4 vacancies we will choose row which have 3 seats.
     * 
     * @param array $value - Contains data of how many rows contains how many seats in sorted order.
     * @param int $len - Contains the length of the previous array
     * @param int $required - The number of seats required.
     * 
     * @return int $left - The index of $value which is the best fit.
     */
    private function upperBound($value, $len, $required) {
        $left = 0;
        $right = $len;
        while($left < $right) {
            $mid = $left + intval(floor(($right - $left) / 2));
            if($value[$mid]->left >= $required)
                $right = $mid;
            else 
                $left = $mid + 1;
        }

        if($left < $len && $value[$left]->left < $required)
            $left += 1;
        
        return $left;
    }
}