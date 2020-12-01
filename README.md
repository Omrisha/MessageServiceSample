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
* Go to http://localhost:80/messages with your client (Google Chrome, Postman, etc...)

## Usage

 - GET      /api/v1/books - get all books
 - GET      /api/v1/books/:id - get book by id (FUTURE)
 - POST     /api/v1/books - create new book (FUTURE)
 - PUT      /api/v1/books - update new book (FUTURE)
 - DELETE   /api/v1/bools/:id - delete book by id (FUTURE)

## JSON example

    {
      "title": "Unlocking Android",
      "isbn": "1933988673",
      "pageCount": 416,
      "publishedDate": { "$date": "2009-04-01T00:00:00.000-0700" },
      "thumbnailUrl": "https://s3.amazonaws.com/AKIAJC5RLADLUMVRPFDQ.book-thumb-images/ableson.jpg",
      "shortDescription": "Unlocking Android: A Developer's Guide provides concise, hands-on instruction for the Android operating system and development tools. This book teaches important architectural concepts in a straightforward writing style and builds on this with practical and useful examples throughout.",
      "longDescription": "Android is an open source mobile phone platform based on the Linux operating system and developed by the Open Handset Alliance, a consortium of over 30 hardware, software and telecom companies that focus on open standards for mobile devices. Led by search giant, Google, Android is designed to deliver a better and more open and cost effective mobile experience.    Unlocking Android: A Developer's Guide provides concise, hands-on instruction for the Android operating system and development tools. This book teaches important architectural concepts in a straightforward writing style and builds on this with practical and useful examples throughout. Based on his mobile development experience and his deep knowledge of the arcane Android technical documentation, the author conveys the know-how you need to develop practical applications that build upon or replace any of Androids features, however small.    Unlocking Android: A Developer's Guide prepares the reader to embrace the platform in easy-to-understand language and builds on this foundation with re-usable Java code examples. It is ideal for corporate and hobbyists alike who have an interest, or a mandate, to deliver software functionality for cell phones.    WHAT'S INSIDE:        * Android's place in the market      * Using the Eclipse environment for Android development      * The Intents - how and why they are used      * Application classes:            o Activity            o Service            o IntentReceiver       * User interface design      * Using the ContentProvider to manage data      * Persisting data with the SQLite database      * Networking examples      * Telephony applications      * Notification methods      * OpenGL, animation & multimedia      * Sample Applications  ",
      "status": "PUBLISH",
      "authors": ["W. Frank Ableson", "Charlie Collins", "Robi Sen"],
      "categories": ["Open Source", "Mobile"]
    }    