<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About This Project

This is an assignment Project. This repository contains the backend code for the application. The frontend code is available [here](https://github.com/vivekjoshi556/assignment_frontend.git)

## Run this project.
- To get started you will need latest version of php in your system. To install you can select your system and get started with the installation [[Guide](https://www.php.net/manual/en/install.php)].
- You will also need composer to install the dependencies of the project [[Guide](https://getcomposer.org/doc/00-intro.md)].
- Install Mysql on your system [[Guide](https://dev.mysql.com/doc/mysql-installation-excerpt/5.7/en/)].
- To get started with this project you either download this project manually or using git.

        > git clone git@github.com:vivekjoshi556/assignment_backend.git

- Once downloaded go into the folder and use this command to install dependencies:

        > composer install

- Once the dependencies are downloaded set the environment variables. To do so create a .env from and copy the content from .env.example to your .env file.
- Change the key values appropriately.
- Once all this done let's setup our database. To do so login to your database and create a database - [[Guide](https://dev.mysql.com/doc/refman/8.0/en/creating-database.html)].
- Setup database settings in your .env file.
- Then go back to your terminal and run 

        > php artisan migrate:fresh --seed

    This will create all the required tables and set the required data in your database for you.

## Endpoints

There are 4 endpoints provided in this application:

> /api/seats

This will return the rows in the coach. Each row will contain 3 values 
- Method: GET
- row - row_id of that row
- total - total number of seats in that row.
- left - remaining seats in that row.

> /api/bookings

This returns the seats booked by current user.
- Method: GET
- This will return row_id as keys and seats in that row as values.

> /api/bookSeats

This method makes a seat booking request.
- METHOD: POST
- Expects a num_seats(number of seats) as value in the request.
- In case of error a key named status with value error is returned and appropriate error message is returned.
- In case of success a key named status with value success is returned. The new seats of the users are also returned.

> /api/resetDB
- METHOD: GET
- This resets the database to initial state where no bookings were made.