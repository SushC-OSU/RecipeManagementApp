Instructions to Set up the Project and Execute the code:
•	Install Xampp: Download XAMPP (apachefriends.org)
•	Install Composer: Composer (getcomposer.org)
•	Inside htdocs, open command prompt and create a new laravel project - composer create-project --prefer-dist laravel/laravel RecipeManagementApp
•	A new folder will be created. In command prompt, navigate to that folder-  cd RecipeManagementApp
•	Import the code.
•	Create a database. Set up username and password.
•	Create an .env file from .env_example file and update the database name, username and password.
•	Open database.php file from config and update the database name, username and password.
mysql =>['database' => env('DB_DATABASE', 'recipe_app'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),]
•	 The last two operations is used to connect the database and application.
•	Execute php artisan make:auth – This is used to create default login functionality.
•	Run php artisan migrate – This is used to migrate the database tables required for login functionality.
•	Install node and npm - Downloading and installing Node.js and npm | npm Docs (npmjs.com)
•	Run npm run dev.
•	Run php artisan serve – This will give an url. Hit the URL in browser, The application will be opened. 
//The database table structures will be automatically stored in the database migration files. Executing php artisan serve will automatically create table. 
// Procedure, Triggers and View are created using laravel’s migration. So, executing php artisan migrate will work.

