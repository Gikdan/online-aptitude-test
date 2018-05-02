# online-aptitude-test
This is an api based online aptitude test for multiple answer questions.

## Getting Started

To use this template, choose one of the following options to get started:

* Download the latest release as ZIP file from GitHub
* Clone this repository from GitHub


## Prerequisites
To run online-aptitude-test backend on your server you need one of these PHP versions:

  * 5.6
  * 7.0
  * 7.1

* Apache Server
* Mysql or any other database engine
* Laravel 

## Installing
simply run the commands below to install project dependencies and serve to start consuming the API:

    $ /opt/lampp/lampp start  #to start apache server and mysql.Use any command that suits your case to start your server and your database engine.
    $ composer install  #to install the project dependencies
    * Update the .env file in the app root directory and set your database password and database name
    * Make sure that the provided database already exist, if not creat it.                                                                        
   
    $ php artisan migrate  #to create all the tables as defined in the migrations folder.
    $ php artisan db:seed  #to create default users and user types.
    $ php artisan passport:install  #to create the encryption keys needed to generate secure access tokens
    * Update the .env file the app root directory and set PASSWORD_GRANT_CLIENT_ID and PASSWORD_GRANT_CLIENT_SECRET generatec above.
    $ php artisan serve #to serve the api locally at port 8000
 
## Running the tests
* Use POSTMAN to test user login.
  * Endpoint : localhost:8000/api/v1/login
  * Method : POST
  * Parameters : { username:danielmboya12@gmail.com, password:12345678}
* result:{ token:token_value,
            }
## Deployment
## Built With
PHP laravel framework
