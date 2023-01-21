<?php


require dirname(__FILE__).'/vendor/autoload.php';

function greet($hostname, $name)
{
    $client = new Kaamelott\KaamelottClient($hostname, [
        'credentials' => Grpc\ChannelCredentials::createInsecure(),
    ]);



    $request = new \Kaamelott\RandomQuoteRequest();
    list($response, $status) = $client->getRandomQuote($request)->wait();

    echo sprintf(
        '%s (%s)',
        $response->getQuote(),
        $response->getInfos()->getCharacter()
    );

    echo PHP_EOL;

    return;
}

$name = !empty($argv[1]) ? $argv[1] : 'world';
$hostname = !empty($argv[2]) ? $argv[2] : 'localhost:50051';

greet($hostname, $name);

