# Books Service

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
* Go to http://localhost:80/api/v1/books with your client (Google Chrome, Postman, etc...)

## Usage

 - GET      /api/v1/books - get all books
 - GET      /api/v1/books?isbn={isbn_number} - get book by id 
 - POST     /api/v1/books - create new book 
 - PUT      /api/v1/books?isbn={isbn_number} - update new book 
 - DELETE   /api/v1/books?isbn={isbn_number} - delete book by id
## JSON example

    {
      "title": "Unlocking Android",
      "isbn": "1933988673",
      "pageCount": 416,
      "publishedDate": { "$date": "2009-04-01T00:00:00.000-0700" },
      "thumbnailUrl": "https://s3.amazonaws.com/AKIAJC5RLADLUMVRPFDQ.book-thumb-images/ableson.jpg",
      "shortDescription": "Short Description",
      "longDescription": "Long Description",
      "status": "PUBLISH",
      "authors": ["Omri S"],
      "categories": ["Open Source", "Mobile"]
    }    
