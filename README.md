## About Expense Manager
This is a sample Expense Manager project.

## To install and run

1. git clone https://github.com/OdelGreg/expense-manager.git
2. cd expense-manager
3. cp .env.example .env #set the correct Database to hold the data of the project
4. composer install  # if you do not have a composer yet, pleae install by running "curl -sS https://getcomposer.org/installer | php" then run "./composer.phar install"
5. npm install
6. npm run dev
7. php artisan migrate
8a. php artisan tinker
8b. factory(\App\User::class)->create(); // note the created user email
9. php artisan serve
10. Visit in you browser http://127.0.0.1:8000/
11. login with the previous created user email and the password if "password"

