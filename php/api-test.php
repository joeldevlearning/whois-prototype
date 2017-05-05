<?php
declare(strict_types=1);
error_reporting(E_ALL | E_STRICT);
require __DIR__.'/vendor/autoload.php';

use RestQuery\Query;
use RestQuery\Action\Setup\{
    Filter, Validate, Create
};
use RestQuery\Action\{
    Build as build,Request as request, Respond as respond
};
use GuzzleHttp\Promise;

//define input
$qSelectors = Filter::httpGetSelectors();
$qParameters = Filter::httpGetParameters();
//var_dump($qSelectors);
Validate::input($qSelectors);

//create selector objects
$primary = Create::Selector('primary', $qSelectors);
$secondary = Create::Selector('secondary', $qSelectors);

//create query object
$q = Create::Query($primary, $secondary, $qParameters);

//var_dump($q);

build::CreateUriFixed($q);

$client = request::CreateClient($q);
$promisesArrayOf = request::CreatePromises($q, $client);
Promise\settle($promisesArrayOf)->wait();

respond::SendResults($q);

