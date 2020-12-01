<?php

use Utopia\App;
use Utopia\Exception;

class MessageEntity {
    public $id;
    public $message;
}

$fakeData = array();

App::get('/messages')
     // Define Route
    ->action(
        function() use ($request, $response) {
            $response
              ->json($fakeData);
        }, ['response']);

App::post('/messages')
    ->param('message', '', new Text(100), 'Message from user')
    ->param('id', '', new UID(), 'Id of the message')
    ->action(
        function() use($message, $id, $response) {
            $entity = new MessageEntity();
            $entity->$id = $id;
            $entity->$message = $message;

            for ($i = 0; $i < $length; $i++) {
                if ($fakeData[$i]->$id == $id) {
                    throw new Exception('Message is already exist with this Id.', 409)
                }
            }

            array_push($fakeData, $entity);
            $response
                ->setStatusCode(Response::STATUS_CODE_CREATED)
                ->json($entity);
        }, ['response']);

App::delete('/messages/:id')
    ->param('id', '', new UID(), 'Id of the message')
    ->action(
        function() use($id, $response) {
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
    ->param('message', '', 'Message from user')
    ->param('id', '', 'Id of the message')
    ->action(
        function() use($message, $id, $response) {

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

