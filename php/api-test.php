<?php
error_reporting(E_ALL | E_STRICT);
require('vendor/autoload.php');
use RestQuery\Query; 
use RestQuery\Action\Run as run;
use RestQuery\Action\Respond as respond;
use GuzzleHttp\Client as client;


//test sending and receiving queries

//setup
$q = new Query();
$q->qElements['pr'] = "Apple";
$q->qType = 1;
$tempQuery = 'orgs;name=Apple*';//manually define query

//check setup
print_r($q->qElements);
//print_r($q->qRunQueue);
//manually create client
$client = new client(
            ['base_uri' => $q->qUriParts['base-uri']]
        );

$promise = $client->getAsync(
    $tempQuery, 
    ['headers' => ['Accept'     => 'application/json']]
)->then(
    function ($response) {
        $data = json_decode($response->getBody(), true);
        print_r($data);
        return $data;
    },
    function ($e) {
        $response = $e->getResponse();
        print_r($response->getStatusCode());
    }
);
$promise->wait();
//$data = $response->getBody();


//respond::Results($data);


//1 - hardcoded query, sync call API and print json WORKS
//2 - hardcoded query, async call and print json WORKS
//3 - hardcoded query, async call and pass json raw
//4 - hardcoded query, two async calls
