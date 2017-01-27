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
$q->qType = 1;
$tempQuery = 'orgs;name=Apple*';//manually define query

//check setup
print_r($q->qSelectors);
//print_r($q->qRunQueue);

//manually create client
$client = new client(
            ['base_uri' => $q->qUriParts['base-uri']]
        );

$response = $client->request(
    'GET', $tempQuery, 
    ['headers' => ['Accept'     => 'application/json']]
);
        
$data = $response->getBody();

respond::Results($data);


//1 - fixed query, sync call API and print json WORKS
//2 - fixed query, async call and print json 
