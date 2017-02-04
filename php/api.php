<?php
error_reporting(E_ALL | E_STRICT);
require __DIR__.'/vendor/autoload.php';

use RestQuery\Query;
use RestQuery\Action\{Clean as clean,Analyze as analyze,Build as build,Request as request, Respond as respond};
use GuzzleHttp\Promise;

//setup
$q = new Query();
//$q->qSelectors['pr'] = "Apple"; //wildcards enabled by default
$q->qType = 1;

clean::Sanitize($q);
clean::Validate($q);

analyze::WhatRecordsToQuery($q);


build::CreateUri($q);


/*$q->qRunQueue = array(
    'orgs;name=Apple*',
    'pocs;name=Apple*',
    'customers;name=Apple*',
    'nets;name=Apple*',
    'asns;name=AppleAppleAple*'
);*/

$client = request::CreateClient($q);
$promisesArrayOf = request::CreatePromises($q, $client);
Promise\settle($promisesArrayOf)->wait();

respond::SendResults($q);


