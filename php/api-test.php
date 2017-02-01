<?php
error_reporting(E_ALL | E_STRICT);
require __DIR__.'/vendor/autoload.php';

use RestQuery\Query;
use RestQuery\Action\{Clean as clean,Analyze as analyze,Build as build,Run as run, Respond as respond};

//setup
$q = new Query();
//$q->qSelectors['pr'] = "Apple"; //wildcards enabled by default
$q->qType = 1;

clean::ValidateSelectors($q);
analyze::IsQueryValid($q);
analyze::WhatRecordsToQuery($q);


build::CreateUri($q);

/*
$q->qRunQueue = array(
    'orgs;name=Apple*',
    'pocs;name=Smith*',
    'customers;name=Apple*',
    'nets;name=Apple*',
    'asns;name=Apple*'
);*/

$client = run::CreateClient($q);
$promisesArrayOf = run::CreatePromises($q, $client);
run::StorePromiseResults($q, $promisesArrayOf);

respond::SendResults($q);

