<?php 
require('vendor/autoload.php');
use GuzzleHttp\Client;

$client = new GuzzleHttp\Client(['base_uri' => 'http://whois.arin.net/rest/']);
$response = $client->request('GET', 'orgs;name=Apple*', [
    'headers' => [ 'Accept'     => 'application/json' ]
]);

$statusCode = $response->getStatusCode(); // 200
$reasonText = $response->getReasonPhrase(); // OK
$body = $response->getBody();

$data = json_decode($body, true);
?>

<pre>
<?php print_r($data); ?>
</pre>



