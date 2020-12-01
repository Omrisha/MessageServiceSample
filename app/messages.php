<?php

use Utopia\App;
use Utopia\Exception;
use Utopia\Swoole\Request;
use Utopia\CLI\Console;
use Utopia\Validator\Text;
use Utopia\Validator\Range;

App::get('/messages')
    ->desc('Get messages')
    ->groups(['api', 'messages'])
    ->action(function ($response) {
        $response->json([
            'message' => "Hello World!",
            'id' => 1
            ]);
    }, ['response']);

App::post('/messages')
    ->desc('POST message')
    ->groups(['api', 'messages'])
    ->action(function ($response) {
        $response
            ->json([
                'message' => 'HELLO',
                'id' => 50
                ]);
    }, ['response']);

App::delete('/messages')
    ->param('id', '', new Range(0, 100), 'Id of the message', true)
    ->action(function($id, $response) {

            $response
                ->setStatusCode(Response::STATUS_CODE_OK);
        }, ['id', 'response']);

App::put('/messages')
    ->param('id', '', new Range(0, 100), 'Id of the message', true)
    ->action(function($id, $response) {
            Console::log("Hi From PUT");

            $response
                ->setStatusCode(Response::STATUS_CODE_OK)
                ->json([
                    'message' => 'EDITED',
                    'id' => $id
                ]);
        }, ['id', 'response']);