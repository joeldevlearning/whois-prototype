<?php
error_reporting(E_ALL | E_STRICT);
require('vendor/autoload.php');

use RestQuery\Query;
use RestQuery\Action\Run as run;
use RestQuery\Action\Respond as respond;

use GuzzleHttp\Promise;
use GuzzleHttp\Client as client;
use GuzzleHttp\Exception\RequestException;

use Psr\Http\Message\ResponseInterface;


//setup
$q = new Query();
$q->qSelectors['pr'] = "Apple";
$q->qType = 1;

$q->qRunQueue = array(
    'orgs;name=Apple*',
    'pocs;name=Smith*',
    'customers;name=Apple*',
    'nets;name=Apple*',
    'asns;name=Apple*'
);

$client = run::CreateClient($q);
$promisesArrayOf = run::CreatePromises($q, $client);
run::StorePromiseResults($q, $promisesArrayOf);

respond::SendResults($q);


//8 - hook up to analyzer and builder, then test sending results back to client