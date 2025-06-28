## Instructions
1. Clone the project in your local
2. create database "any name"
3. Copy the .env.example to .env
4. Update the database connection in the .env 

DB_CONNECTION=mysql 
DB_HOST="<database server name>"
DB_PORT="<database port>"
DB_DATABASE="<database name>"
DB_USERNAME="<database username>"
DB_PASSWORD="<database password>"

5. Run migration 
php artisan migrate 

6. Seed Roles and Permissions Data (Default Value) run command below 
php artisan db:seed 

7. Seed Roles Permission Data run command below 
php artisan db:seed --class=RolesPermissionsSeeder 

8. Seed AdminUsers Data run command below 
php artisan db:seed --class=AdminUsersSeeder 
