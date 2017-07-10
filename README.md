# MultiTenant
MultiTenant Project Repository

Project Setup
==============

 - Install composer: https://getcomposer.org/doc/00-intro.md

 - Create a MySQL database for the project.

 - Create a file called .env:
```
	'DB_HOST' = 'HOST'
    'DB_DATABASE' = 'DATABASE',
    'DB_USERNAME' = 'USERNAME',
    'DB_PASSWORD' = 'PASSWORD'
    
Replace with your connection info.

 - From the project directory,
   1. `composer install`

      That will download dependencies.
      
   2. `php artisan migrate`

      That will apply database migrations

   3. `php artisan db:seed`

      That will generate AdminUser

   4. `php artisan serve`

      That will start the dev server

Every time you Clone , you should run those 6 commands.

Local Credentials
=========================
	-Username : admin@multitenant.com
	-Password : admin