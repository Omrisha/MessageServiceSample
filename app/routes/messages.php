<?php

use Utopia\App;
use Utopia\Exception;
use Utopia\Swoole\Request;
use Utopia\CLI\Console;
use Utopia\Validator\Text;
use Utopia\Validator\Range;

if (!defined("IN_APP")) die;

App::get('/messages')
    ->desc('Get messages')
    ->groups(['api', 'messages'])
    ->action(function ($response) {
        $response->json([
            'message' => "Hello World!",
            'id' => 1
            ]);
    }, ['response']);