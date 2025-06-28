1. Clone the project in your file

2. create database 

3. Update the database connection in the .env

4. Run migration
php artisan migrate 

5. Seed Roles and Permissions Data (Default Value) run command below
php artisan db:seed

6. Seed Roles Permission Data run command below
php artisan db:seed --class=RolesPermissionsSeeder

7. Seed AdminUsers Data run command below
php artisan db:seed --class=AdminUsersSeeder

