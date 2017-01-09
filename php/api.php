<?php 
'vendor/autoload.php';

//orgs;name=Apple*

$client = new GuzzleHttp\Client(['base_uri' => 'http://whois.arin.net/rest/']);

$response = $client->get('orgs;name=Apple*');

$statusCode = $response->getStatusCode(); // 200
$reasonText = $response->getReasonPhrase(); // OK
$body = $response->getBody();

echo $body;

