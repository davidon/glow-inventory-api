* Under the project folder, run:  
  `composer install`  

* Start local web server:
  `php -S localhost:8000 -t public`
  
* Setup local MySQL database according to the configuration in .env file:
```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lumen
DB_USERNAME=root
DB_PASSWORD=password
```
Or change the .env file to use your existing database name, username and password.  

Table name is `inventory`, and this name cannot be changed.
*     
  `php artisan migrate:install`  
  `php artisan migrate`  
  
* The testing data has been prepared with migration script.   
  
* To make unit test, run:
`vendor/bin/phpunit`

### test in Postman
* To test the API in Postman, enter the following data:  
  * url: http://localhost:8000/api/inventory  
  * select `POST` method  
  
* Under `Body` tab, choose `raw` and `JSON`,  and paste the following data into the body:  
```json
{
  "name": "Beetroot Dip",
  "ingredients": {
    "beetroot": 440,
    "cheese": 250,
    "mint": 1
  }
}
```
* Under `Headers` tab, make sure `Content-Type` is ticked and its value is `application/json`.  

* See the screen shot `glow-api-postman-test.png` under `docs` folder for the whole picture.
