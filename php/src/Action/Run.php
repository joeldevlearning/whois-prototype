<?php
namespace RestQuery\Action;
use RestQuery\Query;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;
use Psr\Http\Message\RequestInterface;

class Run {
    /**
     * @param $q
     * @return $client
     */
    public static function CreateClient( Query $q)
    {
        $client = new Client(
            ['base_uri' => $q->qUriParts['base-uri']], //hardcoded uri to rest interface
            ['headers' => ['Accept' => 'application/json']] //for some reason this does NOT set the default, Why?
        );
        return $client;
    }

    /**
     * @param $q
     * @param $client
     * @return array
     */
    public static function CreatePromises(Query $q, Client $client): array
    {
        $promisesArrayOf = array();
        foreach ($q->qRunQueue as $queryString) {
            array_push($promisesArrayOf, $client->getAsync($queryString, ['headers' => ['Accept' => 'application/json']]));//HACK default setting not working, so force it here
        }
        return $promisesArrayOf;
    }

    /**
     * @param $promisesArrayOf
     */
    public static function StorePromiseResults(Query $q, array $promisesArrayOf)
    {
        $rawResultsArrayOf = Promise\unwrap($promisesArrayOf);//wait for all promises passed to unwrap to resolve

        $finalResultsArrayOf = array();

        foreach ($rawResultsArrayOf as $key => $queryResult) {
            array_push($q->qTransformQueue, $rawResultsArrayOf[$key]->getBody()->getContents());
        }
    }










    public static function OldCreateClient(Query $query){
        $handlerStack = new HandlerStack();
        $handlerStack->setHandler(new CurlHandler());
        $handlerStack->push(self::add_header('Accept', 'application/json'));
        
        $client = new Client(
            ['base_uri' => $query->qUriParts['base-uri']],
            ['handler' => $handlerStack]
        );
        return $client;        
    }


    public static function ProcessQueue(Query $query, Client $client){
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

Two tricky cases:
1) Chaining queries together, 
e.g. call first query, parse results, run some logic, and then make a follow-up query

2) After returning results, creating links to related records
e.g. if we return orgs, create links to each org's related records
and can we prevent these from being "no results" but without delaying search results?

*/

}