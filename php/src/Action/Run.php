<?php
namespace RestQuery\Action;
use RestQuery\Query;

use GuzzleHttp\{Client,Promise,HandlerStack,Psr7};
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Exception\{ClientException, RequestException, TransferException};

use Psr\Http\Message\{RequestInterface, ResponseInterface};

class Run {
    /**
     * @param $q
     * @return $client
     */
    public static function CreateClient( Query $q)
    {
        $client = new Client(
            ['base_uri' => $q->qUriParts['base-uri']], //hardcoded uri to rest interface
            ['headers' => ['Accept' => 'application/json']], //for some reason this does NOT set the default, Why?
            ['http_errors' => false]
        );
            return $client;

    }

    /**
     * @param $q
     * @param $client
     * @return array
     */
    public static function CreatePromises(Query $q, Client $client): array
    {
        $promisesArrayOf = array();
        foreach ($q->qRunQueue as $queryString) {
            $promise = $client->getAsync($queryString,
                ['headers' => ['Accept' => 'application/json']]
            )->then(
                function (ResponseInterface $res) use ($q) {
                    $q->qTransformQueue[] = $res->getBody()->getContents();
                    $q->qReportQueue[] = $res->getStatusCode() . ',' . $res->getReasonPhrase();
                },
                function (RequestException $e) use ($q) {
                    $q->qReportQueue[] = $e->getCode() . ',' . $e->getMessage();
                    //echo "Path: ".$e->getRequest()->getRequestTarget(), '<br>';
                }
            )
            ;

            $promisesArrayOf[] = $promise;
        }
        return $promisesArrayOf;
    }


    public static function CapturePromiseResults( Query $q, ResponseInterface $res ) {
        $q->qTransformQueue[] = $res->getBody()->getContents();
    }

    public static function SyncPromises( array $promisesArray ) {
        Promise\settle($promisesArray)->wait();
    }


}