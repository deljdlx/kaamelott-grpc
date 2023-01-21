<?php
namespace Kaamelott;

class Service extends KaamelottStub
{

    private $quotes = [];
    private $quotesCount = 0;

    public function __construct(string $file)
    {
        $data = json_decode(
            file_get_contents($file),
            true,
        );
        $this->quotes = $data['quotes'];
        $this->quotesCount = count($this->quotes);
    }

    public function getRandomQuote(\Kaamelott\RandomQuoteRequest $request,\Grpc\ServerContext $serverContext): ?\Kaamelott\Quote
    {

        $quote = $this->quotes[mt_rand(0, $this->quotesCount - 1)];

        print_r($quote);

        $response = new \Kaamelott\Quote();
        $response->setQuote($quote['quote']);

        $info = new  \Kaamelott\QuoteInfos();
        $info->setCharacter($quote['infos']['character']);
        $info->setSeason($quote['infos']['season']);
        $info->setEpisode($quote['infos']['episode']);
        $info->setActor($quote['infos']['actor']);

        $response->setInfos($info);
        return $response;
    }
}
