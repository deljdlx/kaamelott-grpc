<?php

use Kaamelott\Service;

require dirname(__FILE__) . '/vendor/autoload.php';


$server = new \Grpc\RpcServer();
$server->addHttp2Port('0.0.0.0:50051');
$server->handle(new Service(__DIR__ . '/kaamelott.json'));
$server->run();
