## System Requirements
Laravel Version : 12 <br/>
PHP : 8.2 <br/>
Database : MySQL <br/>
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

5. Open the cmd or command line <br />
6. Go to the projects folder <br />
7. Run <br/ >
npm install <br />
composer install <br />

8. Run migration <br />
php artisan migrate 

9. Seed Roles and Permissions Data (Default Value) run command below <br />
php artisan db:seed 

10. Seed Roles Permission Data run command below <br />
php artisan db:seed --class=RolesPermissionsSeeder 

11. Seed AdminUsers Data run command below <br />
php artisan db:seed --class=AdminUsersSeeder 

12. Run key generation <br /> 
php artisan key:generate

13. Clear Cache <br /> 
config:cache

14. Link css in the storage/public in the assets
php artisan storage:link

15. Run the laravel project <br />
php artisan serve

16. Go to the page, you should be redirected in the login page

16. Input username and password <br />
username: admin <br />
password: password <br />

18. Now you can test the RBAC
# Notes
1. Admin usertype is the only one that can create roles
2. Base on the permission set in the roles, thats the only action that can be done in the users page
3. You can create Roles but no permission
4. If roles has no permission the user cannot access the users page




