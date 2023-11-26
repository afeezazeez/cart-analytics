# Technical assignment back-end engineer

As part of an engineering team, you are working on an online shopping platform. The sales team wants to know which items were added to a basket, but removed before checkout. They will use this data later for targeted discounts.

Using the agreed upon programming language, build a solution that solves the above problem.

**Scope**

* Focus on the JSON API, not on the look and feel of the application.

**Timing**

You have one week to accomplish the assignment. You decide yourself how much time and effort you invest in it, but one of our colleagues tends to say: "Make sure it is good" ;-). Please send us an email (jobs@madewithlove.com) when you think the assignment is ready for review. Please mention your name, Github username, and a link to what we need to review.


# Solution

## Shop API

## Description
This project was built with Laravel and MYSQL. In this project, an api that helps sales team(admin) know which items were added to a basket, but removed before checkout
was created. Below are other set of endpoints that were created to achieve the desired result

- An api for users (admin and regular users) to login
- An api for users (admin and regular users) to logout
- An api for users (admin and regular users) to view all products in database
- An api for users to add an item to basket
- An api for users to remove an item from basket
- An api for users to checkout after adding items to basket

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
$ php artisan passport:client --personal
$ php artisan serve
```
You should be able to visit your app at your laravel app base url e.g http://localhost:8000 or http://technical-assignment-back-end-engineer-afeezazeez.test/ (Provided you use Laravel Valet).

# Decisions
- Along with the products that were removed from basket before checkout returned by the api, I also returned the cart and user details too.
- Products added to basket, removed but later added aren't returned.


Api postman documentation - https://documenter.getpostman.com/view/9428869/2s9YeD9ZNG

## Test credentials
User
```  
Email:azeezafeez212@gmail.com
Password:password
```

Admin
```  
Email:admin@madewithlove.com
Password:admin
```
