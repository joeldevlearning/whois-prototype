<?php
namespace RestQuery\Action;
use RestQuery\Query;
use GuzzleHttp\Client as restClient;
use GuzzleHttp\Promise;

class Run {
    
    public static function CreateClient(Query $query){
        $client = new restClient(
            ['base_uri' => $query->qUriFragments['base-uri']],
            ['headers'  => ['Accept' => 'application/json']]
        );
        return $client;        
    }


    public static function ProcessQueue(Query $query, restClient $client){
        $tempQuery = 'orgs;name=Apple*';

        $response = $client->request('GET', $tempQuery);
        /*$promise = $client->getAsync($tempQuery);
        
        $promise->then(function ($response) {
            echo 'Got a response! ' . $response->getStatusCode(); 
            return $response;
            });
        */
        $data = $response->getBody();
        return $data;
    }
}