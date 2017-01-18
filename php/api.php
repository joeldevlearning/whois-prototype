<?php
error_reporting(E_ALL | E_STRICT);

require('vendor/autoload.php');
use RestQuery\Query; 
use RestQuery\Action\Clean as clean;
use RestQuery\Action\Analyze as analyze;
use RestQuery\Action\Build as build;
use RestQuery\Action\Run as run;
use GuzzleHttp\Client as restClient;



$q = new Query();
clean::Validate($q);
//print_r($q);

$query_type = analyze::WhatQueryType($q);
print_r($query_type);
print_r($q->qElements);

//step 3, build query, right now just pass a value along
$query = 'orgs;name=' . "Apple" . '*';

//step 4, call ARIN API
$client = new restClient(['base_uri' => 'http://whois.arin.net/rest/']);
$response = $client->request('GET', $query, [
    'headers' => [ 'Accept'     => 'application/json' ]
]);

//step 5, assign results to variable
$statusCode = $response->getStatusCode(); // 200
$reasonText = $response->getReasonPhrase(); // OK
$body = $response->getBody();
$data = json_decode($body, true);
$dataJson = json_encode($data);

//step 6, send data back to client
header('Content-Type: application/json');
echo $dataJson;
