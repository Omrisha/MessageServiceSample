<?php

use Utopia\App;
use Utopia\Exception;
use Utopia\Swoole\Request;
use Utopia\CLI\Console;
use Utopia\Validator\Text;
use Utopia\Validator\Integer;
use Utopia\Validator\Range;

if (!defined("IN_APP")) die;

function get_books() {
    $books_string = file_get_contents(MOCK_DIR . '/books.json');
    if ($books_string === FALSE) {
        throw new \RuntimeException("Could not access the books store.");
    }

    /* Convert from a "standard array" to a dictionary of isbn => books. */
    $books = json_decode($books_string, true);
    foreach ($books as $k => $book) {
        $books[$book['isbn']] = $book;
        unset($books[$k]);
    }

    return $books;
}

App::get(API_BASE_PATH . '/books')
    ->desc('Get all of the available books')
    ->groups(['api', 'books'])
    ->action(function ($response) {
        $response->json(array_values(get_books()));
    }, ['response']);

App::get(API_BASE_PATH . '/books/:isbn')
    ->desc('Get a book by its id')
    ->groups(['api', 'books'])
    ->param('isbn', '', new Integer())
    ->action(function ($isbn, $response) {
        $books = get_books();

        $response->json($books[$isbn]);
    }, ['$isbn', 'response']);


App::post(API_BASE_PATH . '/books')
    ->desc('Create a new book')
    ->groups(['api', 'books'])
    ->action(function ($response) {
        $response->json([
          "title" => "Unlocking Android",
          "isbn"=> "1933988673",
          "pageCount" => 416,
          "publishedDate" => ["date" => "2009-04-01T00:00:00.000-0700"],
          "thumbnailUrl" => "https://s3.amazonaws.com/AKIAJC5RLADLUMVRPFDQ.book-thumb-images/ableson.jpg",
          "shortDescription" => "Unlocking Android: A Developer's Guide provides concise, hands-on instruction for the Android operating system and development tools. This book teaches important architectural concepts in a straightforward writing style and builds on this with practical and useful examples throughout.",
          "longDescription" => "Android is an open source mobile phone platform based on the Linux operating system and developed by the Open Handset Alliance, a consortium of over 30 hardware, software and telecom companies that focus on open standards for mobile devices. Led by search giant, Google, Android is designed to deliver a better and more open and cost effective mobile experience.    Unlocking Android: A Developer's Guide provides concise, hands-on instruction for the Android operating system and development tools. This book teaches important architectural concepts in a straightforward writing style and builds on this with practical and useful examples throughout. Based on his mobile development experience and his deep knowledge of the arcane Android technical documentation, the author conveys the know-how you need to develop practical applications that build upon or replace any of Androids features, however small.    Unlocking Android: A Developer's Guide prepares the reader to embrace the platform in easy-to-understand language and builds on this foundation with re-usable Java code examples. It is ideal for corporate and hobbyists alike who have an interest, or a mandate, to deliver software functionality for cell phones.    WHAT'S INSIDE:        * Android's place in the market      * Using the Eclipse environment for Android development      * The Intents - how and why they are used      * Application classes:            o Activity            o Service            o IntentReceiver       * User interface design      * Using the ContentProvider to manage data      * Persisting data with the SQLite database      * Networking examples      * Telephony applications      * Notification methods      * OpenGL, animation & multimedia      * Sample Applications  ",
          "status" => "PUBLISH",
          "authors" => ["W. Frank Ableson", "Charlie Collins", "Robi Sen"],
          "categories" => ["Open Source", "Mobile"]
        ]);
    }, ['response']);

App::put(API_BASE_PATH . '/books')
    ->desc('Create a new book')
    ->groups(['api', 'books'])
    ->action(function ($response) {
        $response->json([
            "title" => "Unlocking Android Ver. 5",
            "isbn"=> "1933988673",
            "pageCount" => 416,
            "publishedDate" => ["date" => "2020-04-01T00:00:00.000-0700"],
            "thumbnailUrl" => "https://s3.amazonaws.com/AKIAJC5RLADLUMVRPFDQ.book-thumb-images/ableson.jpg",
            "shortDescription" => "Unlocking Android Ver. 5: A Developer's Guide provides concise, hands-on instruction for the Android operating system and development tools. This book teaches important architectural concepts in a straightforward writing style and builds on this with practical and useful examples throughout.",
            "longDescription" => "Android is an open source mobile phone platform based on the Linux operating system and developed by the Open Handset Alliance, a consortium of over 30 hardware, software and telecom companies that focus on open standards for mobile devices. Led by search giant, Google, Android is designed to deliver a better and more open and cost effective mobile experience.    Unlocking Android: A Developer's Guide provides concise, hands-on instruction for the Android operating system and development tools. This book teaches important architectural concepts in a straightforward writing style and builds on this with practical and useful examples throughout. Based on his mobile development experience and his deep knowledge of the arcane Android technical documentation, the author conveys the know-how you need to develop practical applications that build upon or replace any of Androids features, however small.    Unlocking Android: A Developer's Guide prepares the reader to embrace the platform in easy-to-understand language and builds on this foundation with re-usable Java code examples. It is ideal for corporate and hobbyists alike who have an interest, or a mandate, to deliver software functionality for cell phones.    WHAT'S INSIDE:        * Android's place in the market      * Using the Eclipse environment for Android development      * The Intents - how and why they are used      * Application classes:            o Activity            o Service            o IntentReceiver       * User interface design      * Using the ContentProvider to manage data      * Persisting data with the SQLite database      * Networking examples      * Telephony applications      * Notification methods      * OpenGL, animation & multimedia      * Sample Applications  ",
            "status" => "PUBLISH",
            "authors" => ["W. Frank Ableson", "Charlie Collins", "Robi Sen"],
            "categories" => ["Open Source", "Mobile"]
        ]);
    }, ['response']);