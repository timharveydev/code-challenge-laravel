# CODE CHALLENEGE - LARAVEL API

## INSTALLATION & SETUP

To set up this project on your local machine, follow the steps below:

1. Open your prefered local server client (I used Laragon) and open your prefered database client (I used HeidiSQL). Make sure you are using PHP 8 (I built this project using PHP 8.1.8).
2. Create a new database and run the database SQL file that was sent to you via email. Your database should now be populated and ready to use.
(2.5). Alternatively, if you would rather start with an empty database: create a new database and don't import the SQL file. You can then run the command "php artisan migrate" from your root directory to create the database tables as defined in the migration files.
3. Clone the project code from this repository to a directory on your local machine.
4. Copy the contents of the ".env.example" file from the project's root into a new file called ".env". Then enter your database connection details for the database you just set up.
5. In your terminal, cd into the project directory. Run the command "composer install" to install all of Laravel's dependencies.
6. Lastly, run the command "php artisan serve". The laravel site should now be up and running at the following address "127.0.0.1:8000".

If everything worked correctly, you should now be presented wth the default Laravel homepage.


## KEY FOLDERS & FILES

If you haven't worked with Laravel before, here is a quick breakdown of the key folders and files used in this project:

- app
    - Http
        - Controllers
            - Api
                - CustomerController.php -> this is the main controller used for displaying, updating and creating new Customers.

        - Requests
            - StoreCustomerRequest.php -> this custom request class includes validation rules which are applied to all incoming Customer-related requests from the client to the API.

        - Resources
            - CustomerResource.php -> this resource class specifies exactly which fields from the DB are returned to the browser by the API, and how they are formatted.

    - Models
        - Customer.php -> the Customer model specifies which DB fields are fillable, and it also includes some methods to retrieve the Customer's associated Policy and Insurer from the DB.
        - Insurer.php -> the Insurer model specifies which fields are fillable ('customer_id' is a foreign key tied to the 'id' field in the Customers table).
        - Policy.php -> the Policy model specifies which fields are fillable ('customer_id' is a foreign key tied to the 'id' field in the Customers table).

- database
    - migrations
        - ..._create_customers_table.php -> the database schema for the 'customers' table.
        - ..._create_policies_table.php -> the database schema for the 'policies' table. The 'customer_id' column is a foreign key bound to the 'id' column in the 'customers' table.
        - ..._create_insurers_table.php -> the database schema for the 'insurers' table. The 'customer_id' column is a foreign key bound to the 'id' column in the 'customers' table.

- routes
    - api.php -> all of the API routes are specified here.


## HOW TO USE THE API

There are three URL routes that the API offers:

* GET '/api/customers' -> using a GET request to this URL will return all of the Customers in the DB in JSON format, wrapped in an array called 'data'.
* POST '/api/customers' -> using a POST request to this URL will tell the API to store a new Customer in the DB. Data should be sent to the API in JSON format, and the API accepts the following key => value pairs:
    * 'name' => String
    * 'address' => String
    * 'premium' => Int or Float (max. 2 decimal places)
    * 'policy' => String
    * 'insurer' => String
* PUT '/api/customers/{id}' -> using a PUT request and passing in a Customer ID to this URL will tell the API to update the specified Customer. Data should be sent to the API in the same format as for the POST method above.