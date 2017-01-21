<?php
namespace RestQuery\Action;
use RestQuery\Query;
use GuzzleHttp\Client as restClient;
use GuzzleHttp\Promise;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use Psr\Http\Message\RequestInterface;

class Run {
    
    public static function CreateClient(Query $query){
        $handlerStack = new HandlerStack();
        $handlerStack->setHandler(new CurlHandler());
        $handlerStack->push(self::add_header('Accept', 'application/json'));
        
        $client = new restClient(
            ['base_uri' => $query->qUriFragments['base-uri']],
            ['handler' => $handlerStack]
        );
        return $client;        
    }


    public static function ProcessQueue(Query $query, restClient $client){
        $tempQuery = 'orgs;name=Apple*';

        $response = $client->request('GET', $tempQuery, ['headers' => ['Accept'     => 'application/json']]);
        /*$promise = $client->getAsync($tempQuery);
        
        $promise->then(function ($response) {
            echo 'Got a response! ' . $response->getStatusCode(); 
            return $response;
            });
        */
        $data = $response->getBody();
        return $data;
    }

    
    //from http://docs.guzzlephp.org/en/latest/handlers-and-middleware.html
    //this function adds middleware to a handler
    //in this case we just want to add the application/json header
    public static function add_header($header, $value)
    {
        return function (callable $handler) use ($header, $value) {
            return function (
                RequestInterface $request,
                array $options
            ) use ($handler, $header, $value) {
                $request = $request->withHeader($header, $value);
                return $handler($request, $options);
            };
        };
    }


}