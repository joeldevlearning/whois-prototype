<?php 
error_reporting(E_ALL | E_STRICT);

//require('api-helper.php');
require('vendor/autoload.php');
use GuzzleHttp\Client;

//step 1, assign input to query
//need to refactor to test if other fields are set; if so, make correct type of query
$pr = filter_input(INPUT_GET, 'pr', FILTER_SANITIZE_STRING);

//step 2, check for wildcards
//step 3, build out queries

$query = 'orgs;name=' . $pr . '*';
//pass into ARIN APIs
$client = new GuzzleHttp\Client(['base_uri' => 'http://whois.arin.net/rest/']);
$response = $client->request('GET', $query, [
    'headers' => [ 'Accept'     => 'application/json' ]
]);

$statusCode = $response->getStatusCode(); // 200
$reasonText = $response->getReasonPhrase(); // OK
$body = $response->getBody();
$data = json_decode($body, true);
$dataJson = json_encode($data);

/*
$testDidReturnJson = function ($body) {
$dataJson = "<pre>" . print_r($body) . "</pre>";
  return $dataJson;
};
$testDidReturnJson($body);
*/

$testDidDecodeJson = function ($data) {
  $dataArray = "<pre>" . print_r($data) . "</pre><br><br><br>";
  return $dataArray;
};

$testDidEncodeJson = function ($data) {
  $dataRawJson =  "<pre>" . print_r($data) . "</pre><br><br>"; 
  return $dataRawJson;
};

$testDidEncodeJson($dataJson);
$testDidDecodeJson($data);

?>




