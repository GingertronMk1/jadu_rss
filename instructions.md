# Instructions

This application runs using the Laravel PHP framework, whose installation requirements can be found (here)[https://laravel.com/docs/master/].
For my installation I used the MySQL server found downloadable via Homebrew, however Laravel's inherent DB-agnosticism means any database server could be used.

Once you have installed Laravel, navigate to the folder that contains this file and copy `.env.example` to `.env`.
Replace the `DB_` variables with the ones that correspond to your database server and db, then run `php artisan migrate:fresh` to set up the tables within it.
Optionally, you can run `php artisan migrate:fresh --seed` to seed the database with 5 users, each with 3 feeds associated to them.
