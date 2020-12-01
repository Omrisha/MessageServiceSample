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

App::get(API_BASE_PATH . '/books/:id')
    ->desc('Get a book by its id')
    ->groups(['api', 'books'])
    ->param('id', '', new Integer())
    ->action(function ($id, $response) {
        $response->json($_GET);
    }, ['response']);


App::post(API_BASE_PATH . '/books')
    ->desc('Create a new book')
    ->groups(['api', 'books'])
    ->param('isbn', '', new Integer())
    ->action(function ($isbn, $response) {
        $response->json($_REQUEST);
    }, ['response']);