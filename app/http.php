<?php

if (file_exists(__DIR__.'/../vendor/autoload.php')) {
    require __DIR__.'/../vendor/autoload.php';
}

use Utopia\App;
use Utopia\Swoole\Request;
use Utopia\Swoole\Response;
use Utopia\Swoole\Files;
use Swoole\Http\Server;
use Swoole\Http\Request as SwooleRequest;
use Swoole\Http\Response as SwooleResponse;

$http = new Server("0.0.0.0", 80);

require __DIR__ . '/messages.php';

$http->on('request', function (SwooleRequest $swooleRequest, SwooleResponse $swooleResponse) {
    $request = new Request($swooleRequest);
    $response = new Response($swooleResponse);

    $app = new App('America/New_York');
    
    try {
        $app->run($request, $response);
    } catch (\Throwable $th) {
        $swooleResponse->end('500: Server Error');
    }
});

$http->start();