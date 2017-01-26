<?php
error_reporting(E_ALL | E_STRICT);
require('vendor/autoload.php');
use RestQuery\Query; 
use RestQuery\Action\Run as run;
use RestQuery\Action\Respond as respond;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise;
use GuzzleHttp\Client as client;


//setup
$q = new Query();
$q->qElements['pr'] = "Apple";
$q->qType = 1;
$tempQueryOne = 'orgs;name=Apple*';//manually define query
$tempQueryTwo = 'pocs;name=Smith*';

$tempRunQueue = [];

//check setup
//print_r($q->qElements);
//manually create client
$client = new client(
            ['base_uri' => $q->qUriParts['base-uri']], //hardcoded uri to rest interface
            ['headers' => ['Accept'     => 'application/json']] //set json to default for all api calls
        );
$promisesArrayOf = [
    'promiseOne' => $client->getAsync($tempQueryOne),
    'promiseTwo' => $client->getAsync($tempQueryTwo)
];

/*
$promise = $client->getAsync(
    $tempQueryOne
)->then(
    function (ResponseInterface $response) {
        $data = json_decode($response->getBody(), true);
        print_r($data);
        return $data;
    },
    function (RequestException $exception) {
        $response = $exception->getResponse();
        print_r($response->getStatusCode());
    }
);*/
$resultsArrayOf = Promise\unwrap($promisesArrayOf);//wait for all promises passed to unwrap to resolve
$resultOne = $resultsArrayOf['promiseOne']->getBody()->getContents();
$resultTwo = $resultsArrayOf['promiseTwo']->getBody()->getContents();

$resultAll = $resultOne . $resultTwo;

print_r($resultAll);
//$data = $response->getBody();


//respond::Results($data);


//1 - hardcoded query, sync call API and print json WORKS
//2 - hardcoded query, async call and print json WORKS
//3 - hardcoded query, async call and pass json raw WORKS
//4 - hardcoded query, two async calls and pass back json WORKS
//5 - hardcoded query, variable number of async calls, pass back everything
/* step 1, foreach queue items into promises array
 * step 2, foreach promises array and make async calls
 * step 3, foreach promises array for results
 * step 4, foreach print results
 */


//6 - hardcoded query, variable async calls, wrap json in new container

//??? send back json with correct status code to client
