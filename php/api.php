<?php 
'vendor/autoload.php';

//orgs;name=Apple*

$client = new GuzzleHttp\Client(['base_uri' => 'http://whois.arin.net/rest/']);

// Send a request to https://foo.com/api/test
$response = $client->request('GET', 'test');
// Send a request to https://foo.com/root
$response = $client->request('GET', '/root');