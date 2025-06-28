## Instructions
1. Clone the project in your local
2. create database "any name"
3. Copy the .env.example to .env
4. Update the database connection in the .env 

DB_CONNECTION=mysql <br />
DB_HOST="<database server name>" <br />
DB_PORT="<database port>" <br />
DB_DATABASE="<database name>" <br />
DB_USERNAME="<database username>" <br />
DB_PASSWORD="<database password>" <br />

5. Run migration <br />
php artisan migrate 

6. Seed Roles and Permissions Data (Default Value) run command below <br />
php artisan db:seed 

7. Seed Roles Permission Data run command below <br />
php artisan db:seed --class=RolesPermissionsSeeder 

8. Seed AdminUsers Data run command below <br />
php artisan db:seed --class=AdminUsersSeeder 
