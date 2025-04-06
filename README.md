## Shop API

## Description
This project was built with Laravel and MYSQL. In this project, A user can log in and add products to cart,remove (if they wish) and also checkout.
A user sample test credentials is given below.
An admin can also login and view all list of products that were added to cart but removed before checkout.
A sample admin test credentials is also given below.
Below are all the of endpoints that were created to achieve the desired result

- An api for users (admin and regular users) to login
- An api for users (admin and regular users) to logout
- An api for users (admin and regular users) to view all products in database
- An api for users to add an item to basket
- An api for users to remove an item from basket
- An api for users to checkout after adding items to basket
- An aoi for an admin to view all list of products that were added to cart but removed before checkout

## Running the App
To run the App, you must have:
- **PHP** (https://www.php.net/downloads)
- **MySQL** (https://www.mysql.com/downloads/)
- **Composer** (https://getcomposer.org/download/)

Clone the repository to your local machine using the command
```console
$ git clone *remote repository url*
```
## Configure app
Create an `.env` and copy `.env.example` content into it using the command.

```console
$ cp .env.example .env
```

### Environment
Configure environment variables in `.env` for dev environment based on your MYSQL database configuration

```  
DB_CONNECTION=<YOUR_MYSQL_TYPE>
DB_HOST=<YOUR_MYSQL_HOST>
DB_PORT=<YOUR_MYSQL_PORT>
DB_DATABASE=<YOUR_DB_NAME>
DB_USERNAME=<YOUR_DB_USERNAME>
DB_PASSWORD=<YOUR_DB_PASSWORD>

```
### LARAVEL INSTALLATION
Install the dependencies and start the server

```console
$ composer install
$ php artisan key:generate
$ php artisan migrate --seed
$ php artisan passport:install
$ php artisan serve
```
You should be able to visit your app at your laravel app base url e.g http://localhost:8000 or http://cart-analytics.test/ (Provided you use Laravel Valet).

Api postman documentation - https://documenter.getpostman.com/view/9428869/2s9YeD9ZNG

## Test credentials
User
```  
Email:azeezafeez212@gmail.com
Password:password
```
