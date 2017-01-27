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
print_r($q->qSelectors);

analyze::WhatRecordsToQuery($q);

build::CreateUri($q);
print_r($q->qRunQueue);

$client = run::CreateClient($q);
$data = run::ProcessQueue($q, $client);


/*

$body = $response->getBody();

*/
respond::Results($data);