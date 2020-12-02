<?php

/* Initialize */
require_once __DIR__ . '/../vendor/autoload.php';

use Utopia\App;
use Utopia\Swoole\Request;
use Utopia\Swoole\Response;
use Utopia\Swoole\Files;
use Swoole\Http\Server;
use Swoole\Http\Request as SwooleRequest;
use Swoole\Http\Response as SwooleResponse;

define("IN_APP", true);
require __DIR__ . '/init.php';

/* Load all of the routes */
foreach (new DirectoryIterator(__DIR__ . '/' . ROUTES_DIRNAME) as $fileInfo) {
    if($fileInfo->isDot()) continue;
    require __DIR__ . '/' . ROUTES_DIRNAME . '/' . $fileInfo->getFilename();
}

/* Setup a Swoole server */
$http = new Server(API_HOST_ADDR, API_HOST_PORT);

/* Listen to each request */
$http->on('request', function (SwooleRequest $swooleRequest, SwooleResponse $swooleResponse) {
    $request = new Request($swooleRequest);
    $response = new Response($swooleResponse);

    var_dump($request);
    $app = new App(API_SERVER_TZ);
    
    try {
        $app->run($request, $response);
    } catch (\Throwable $th) {
        $swooleResponse->end('500: Server Error');
    }
});

$http->start();