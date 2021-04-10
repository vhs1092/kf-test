
----------
Solution: I create a command to handle the expired coops, it is scheduled to run daily, without user interaction.

Command:

php artisan cancel-expired-coops


# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Alternative installation is possible without local dependencies relying on [Docker](#docker). 

Clone the repository

    git clone git@github.com:vhs1092/kf-test.git

Switch to the repo folder

    cd kf-test

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate


Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone git@github.com:vhs1092/kf-test.git
    cd kf-test
    composer install
    cp .env.example .env
    php artisan key:generate
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding with Factory

You can insert dummy data to the database running the facories located at database/factories


    \App\Models\Transaction::factory()->count(10)->create();


## Environment variables

- `.env` - Environment variables can be set in this file

***IMPORTANT*** Set the variables to your email service 


##RUN COMMAND

	php artisan cancel-expired-coops


##Bonus

Consider cases where the coop has ≥ 1000 purchases. Running this process all at once would break because of memory limit issues – coding is optional, you can write down your solution.

Solution: We can create multiple jobs and send them to a queue, for example, for each 50 purchases create a job  and send to the queue