<?php

if (file_exists(__DIR__.'/../vendor/autoload.php')) {
    require __DIR__.'/../vendor/autoload.php';
}
use Utopia\Swoole\Files;
use Utopia\Swoole\Request;
use Utopia\Swoole\Response;
use Swoole\Process;
use Swoole\Http\Server;
use Swoole\Http\Request as SwooleRequest;
use Swoole\Http\Response as SwooleResponse;
use Utopia\App;

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
              ->json([]);
        }, ['response']);

App::post('/messages')
    ->param('message', '', 'Message from user')
    ->param('id', '', 'Id of the message')
    ->action(
        function() use($message, $id, $response) {
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
    ->param('id', '', 'Id of the message')
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

$http = new Server("0.0.0.0", 80);

Files::load(__DIR__ . '/../public'); // Static files location

$http->on('request', function (SwooleRequest $swooleRequest, SwooleResponse $swooleResponse) {
    $request = new Request($swooleRequest);
    $response = new Response($swooleResponse);

    if(Files::isFileLoaded($request->getURI())) { // output static files with cache headers
        $time = (60 * 60 * 24 * 365 * 2); // 45 days cache

        $response
            ->setContentType(Files::getFileMimeType($request->getURI()))
            ->addHeader('Cache-Control', 'public, max-age='.$time)
            ->addHeader('Expires', \date('D, d M Y H:i:s', \time() + $time).' GMT') // 45 days cache
            ->send(Files::getFileContents($request->getURI()))
        ;

        return;
    }

    $app = new App('America/New_York');
    
    try {
        $app->run($request, $response);
    } catch (\Throwable $th) {
        $swooleResponse->end('500: Server Error');
    }
});

$http->start();