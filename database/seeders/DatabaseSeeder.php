<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('coaches')->insert([[
            "row" => 1,
            "seats" => 7,
            "left" => 7
        ],[
            "row" => 2,
            "seats" => 7,
            "left" => 7
        ],[
            "row" => 3,
            "seats" => 7,
            "left" => 7
        ],[
            "row" => 4,
            "seats" => 7,
            "left" => 7
        ],[
            "row" => 5,
            "seats" => 7,
            "left" => 7
        ],[
            "row" => 6,
            "seats" => 7,
            "left" => 7
        ],[
            "row" => 7,
            "seats" => 7,
            "left" => 7
        ],[
            "row" => 8,
            "seats" => 7,
            "left" => 7
        ],[
            "row" => 9,
            "seats" => 7,
            "left" => 7
        ],[
            "row" => 10,
            "seats" => 7,
            "left" => 7
        ],[
            "row" => 11,
            "seats" => 7,
            "left" => 7
        ],[
            "row" => 12,
            "seats" => 3,
            "left" => 3
        ]]);

        DB::table('seats')->insert([
            [ 'row_id' => 1, 'status' => 0],
            [ 'row_id' => 1, 'status' => 0],
            [ 'row_id' => 1, 'status' => 0],
            [ 'row_id' => 1, 'status' => 0],
            [ 'row_id' => 1, 'status' => 0],
            [ 'row_id' => 1, 'status' => 0],
            [ 'row_id' => 1, 'status' => 0],
            [ 'row_id' => 2, 'status' => 0],
            [ 'row_id' => 2, 'status' => 0],
            [ 'row_id' => 2, 'status' => 0],
            [ 'row_id' => 2, 'status' => 0],
            [ 'row_id' => 2, 'status' => 0],
            [ 'row_id' => 2, 'status' => 0],
            [ 'row_id' => 2, 'status' => 0],
            [ 'row_id' => 3, 'status' => 0],
            [ 'row_id' => 3, 'status' => 0],
            [ 'row_id' => 3, 'status' => 0],
            [ 'row_id' => 3, 'status' => 0],
            [ 'row_id' => 3, 'status' => 0],
            [ 'row_id' => 3, 'status' => 0],
            [ 'row_id' => 3, 'status' => 0],
            [ 'row_id' => 4, 'status' => 0],
            [ 'row_id' => 4, 'status' => 0],
            [ 'row_id' => 4, 'status' => 0],
            [ 'row_id' => 4, 'status' => 0],
            [ 'row_id' => 4, 'status' => 0],
            [ 'row_id' => 4, 'status' => 0],
            [ 'row_id' => 4, 'status' => 0],
            [ 'row_id' => 5, 'status' => 0],
            [ 'row_id' => 5, 'status' => 0],
            [ 'row_id' => 5, 'status' => 0],
            [ 'row_id' => 5, 'status' => 0],
            [ 'row_id' => 5, 'status' => 0],
            [ 'row_id' => 5, 'status' => 0],
            [ 'row_id' => 5, 'status' => 0],
            [ 'row_id' => 6, 'status' => 0],
            [ 'row_id' => 6, 'status' => 0],
            [ 'row_id' => 6, 'status' => 0],
            [ 'row_id' => 6, 'status' => 0],
            [ 'row_id' => 6, 'status' => 0],
            [ 'row_id' => 6, 'status' => 0],
            [ 'row_id' => 6, 'status' => 0],
            [ 'row_id' => 7, 'status' => 0],
            [ 'row_id' => 7, 'status' => 0],
            [ 'row_id' => 7, 'status' => 0],
            [ 'row_id' => 7, 'status' => 0],
            [ 'row_id' => 7, 'status' => 0],
            [ 'row_id' => 7, 'status' => 0],
            [ 'row_id' => 7, 'status' => 0],
            [ 'row_id' => 8, 'status' => 0],
            [ 'row_id' => 8, 'status' => 0],
            [ 'row_id' => 8, 'status' => 0],
            [ 'row_id' => 8, 'status' => 0],
            [ 'row_id' => 8, 'status' => 0],
            [ 'row_id' => 8, 'status' => 0],
            [ 'row_id' => 8, 'status' => 0],
            [ 'row_id' => 9, 'status' => 0],
            [ 'row_id' => 9, 'status' => 0],
            [ 'row_id' => 9, 'status' => 0],
            [ 'row_id' => 9, 'status' => 0],
            [ 'row_id' => 9, 'status' => 0],
            [ 'row_id' => 9, 'status' => 0],
            [ 'row_id' => 9, 'status' => 0],
            [ 'row_id' => 10, 'status' => 0],
            [ 'row_id' => 10, 'status' => 0],
            [ 'row_id' => 10, 'status' => 0],
            [ 'row_id' => 10, 'status' => 0],
            [ 'row_id' => 10, 'status' => 0],
            [ 'row_id' => 10, 'status' => 0],
            [ 'row_id' => 10, 'status' => 0],
            [ 'row_id' => 11, 'status' => 0],
            [ 'row_id' => 11, 'status' => 0],
            [ 'row_id' => 11, 'status' => 0],
            [ 'row_id' => 11, 'status' => 0],
            [ 'row_id' => 11, 'status' => 0],
            [ 'row_id' => 11, 'status' => 0],
            [ 'row_id' => 11, 'status' => 0],
            [ 'row_id' => 12, 'status' => 0],
            [ 'row_id' => 12, 'status' => 0],
            [ 'row_id' => 12, 'status' => 0],

        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
