## Diploma Thesis Management System

Installation steps:

- Install PHP 7.4, Apache and MySQL: https://www.apachefriends.org/download.html.
- Create database.
- Install composer: https://getcomposer.org/download/.
- Git clone project.
- Inside project create .env file and set database name/user/password. See .env.example file.
- Inside project run: composer install.
- Inside project run: php artisan migrate --seed.
- Inside project run: php artisan serve.



