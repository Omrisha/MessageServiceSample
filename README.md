# Message Service

A simple books REST API service that contain simple CRUD operation.

It can query for books data.

TODO:
 - Add persistance DB
 - Add update, delete endpoints

## System Requirements

* Docker
* PHP 7.3 or later
* Utopia Framework 
* Utopia Swoole

## Getting Started

* `git clone `
* `docker build -t message-service-appwrite .`
* `docker run -dp 80:80 message-service-appwrite`
* Go to http://localhost:80/messages with your client (Google Chrome, Postman, etc...)