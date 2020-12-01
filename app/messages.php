<?php

use Utopia\App;
use Utopia\Exception;
use Utopia\CLI\Console;

class MessageEntity {
    public $id;
    public $message;
}

$fakeData = array();

App::get('/messages')
    ->desc('Get All messages')
    ->groups(['api', 'messages'])
     // Define Route
    ->action(
        function() use ($request, $response) {
            Console::log("Hi From GET");
            $response
              ->json($fakeData);
        }, ['response']);

App::post('/messages')
    ->desc('Add new message')
    ->groups(['api', 'messages'])
    ->param('message', '', 'Message from user')
    ->param('id', '', 'Id of the message')
    ->action(
        function() use($message, $id, $response) {
            Console::log("Hi From POST");
            $entity = new MessageEntity();
            $entity->$id = $id;
            $entity->$message = $message;

            for ($i = 0; $i < $length; $i++) {
                if ($fakeData[$i]->$id == $id) {
                    throw new Exception('Message is already exist with this Id.', 409);
                }
            }

            array_push($fakeData, $entity);
            $response
                ->setStatusCode(Response::STATUS_CODE_CREATED)
                ->json($entity);
        }, ['response']);

App::delete('/messages/:id')
    ->desc('Delete message by Id')
    ->groups(['api', 'messages'])
    ->param('id', '', 'Id of the message')
    ->action(
        function() use($id, $response) {
            Console::log("Hi From DELETE");
            $length = count($fakeData);
            for ($i = 0; $i < $length; $i++) {
                if ($fakeData[$i]->$id == $id) {
                    unset($fakeData[$i]);
                }
            }

            array_values($fakeData);

            $response
                ->setStatusCode(Response::STATUS_CODE_OK);
        }, ['response']);

App::put('/messages/:id')
    ->desc('Edit message by Id')
    ->groups(['api', 'messages'])
    ->param('message', '', 'Message from user')
    ->param('id', '', 'Id of the message')
    ->action(
        function() use($message, $id, $response) {
            Console::log("Hi From PUT");
            for ($i = 0; $i < $length; $i++) {
                if ($fakeData[$i]->$id == $id) {
                    $fakeData[$i]->$message = $message;
                }
            }

            $response
                ->setStatusCode(Response::STATUS_CODE_OK)
                ->json([
                    'message' => $message,
                    'id' => $id
                ]);
        }, ['response']);