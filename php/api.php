<?php
error_reporting(E_ALL | E_STRICT);

require('vendor/autoload.php');
require('RawQuery.php');
use Utility\Clean as clean;
use Utility\Build as build;
use Utility\Run as run;
use Query\Query as q;
use GuzzleHttp\Client as restClient;


$passInput = clean::Filter();
$cleanInput= clean::Validate($passInput);

//step 3, build query, right now just pass a value along
$query = 'orgs;name=' . $cleanInput['primary_search'] . '*';

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
