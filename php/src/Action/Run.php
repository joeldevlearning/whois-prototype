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
            ['base_uri' => $query->qUriParts['base-uri']],
            ['handler' => $handlerStack]
        );
        return $client;        
    }


    public static function ProcessQueue(Query $query, restClient $client){
        /*fixed query needs to changed

        foreach($query->qRunQueue as $item){
            //run the query and capture the response
            //save the response body to an array
            //return array
            //client then prints array with individual json packets
        }

        */
        
        $tempQuery = 'orgs;name=Apple*';

        $response = $client->request('GET', $tempQuery, ['headers' => ['Accept'     => 'application/json']]);
        
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
/*
What do we need to test here?
1) Can we send a query and get the json back, using Guzzle along the way?
Yes we can. We did this.

2) Can we send TWO queries, get the json back, combine it, and send it along the way?

3) Can we use a promise and do #1 asynchronously?

4) Can we use multiple promises and do #2 async?

5) Can we do #2 with variable numbers of promises, each generated dynamically?

6) Can we combine the json payloads into one?

*/


/*

Two tricky cases:
1) Chaining queries together, 
e.g. call first query, parse results, run some logic, and then make a follow-up query

2) After returning results, creating links to related records
e.g. if we return orgs, create links to each org's related records
and can we prevent these from being "no results" but without delaying search results?

*/

}