<?php
error_reporting(E_ALL | E_STRICT);

require('vendor/autoload.php');
use RestQuery\Query; 
use RestQuery\Action\Clean as clean;
use RestQuery\Action\Analyze as analyze;
use RestQuery\Action\Build as build;
use RestQuery\Action\Run as run;
use RestQuery\Action\Respond as respond;
use GuzzleHttp\Client as restClient;



$q = new Query();
clean::Validate($q);

analyze::IsQueryValid($q);
analyze::WhatQueryType($q);
print_r($q->qType);
print_r($q->qElements);
analyze::WhatRecordsToQuery($q);

//this logic should go inside the 

//step 3, build query, right now just pass a value along
$query = 'orgs;name=' . "Apple" . '*';

//step 4, call ARIN API
$client = new restClient(['base_uri' => $query->qBaseUri]);
$response = $client->request('GET', $query, [
    'headers' => [ 'Accept'     => 'application/json' ]
]);

//step 5, assign results to variable
$statusCode = $response->getStatusCode(); // 200
$reasonText = $response->getReasonPhrase(); // OK
$body = $response->getBody();
$data = json_decode($body, true);

respond::Results($data);