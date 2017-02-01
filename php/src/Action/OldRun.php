<?php
namespace RestQuery\Action;
use RestQuery\Query;

use GuzzleHttp\{Client,Promise,HandlerStack,Psr7};
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Exception\{ClientException, RequestException, TransferException};

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

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


    public static function SyncAndPullPromises(Query $q, array $promisesArray)
    {
        Promise\settle($promisesArray)->wait();//wait for all promises passed to resolve, then unwrap
        //foreach( $rawResultsArrayOf as $key => $queryResult ) {
        //    $q->qTransformQueue[] = $queryResult;


        //}
    }




















    /**
     * @param $promisesArrayOf
     */
    public static function StorePromiseResults(Query $q, array $promisesArrayOf)
    {
        /*try {
            $rawResultsArrayOf = Promise\settle($promisesArrayOf)->wait();//wait for all promises passed to resolve, then unwrap

/*
            foreach ($rawResultsArrayOf as $key => $queryResult) {
                $temp = $queryResult;
                if ($temp['state'] === 'fulfilled') {
                    $q->qTransformQueue[] = $temp['state'];
                }


                //array_push($q->qTransformQueue, $rawResultsArrayOf[$key]->getBody()->getContents());
        }
        /*}
        catch (ClientException $e) {
            $exceptionCode = $e->getCode();
            $exceptionMessage = $e->getMessage();
            //echo $e->getResponse();
        }
        catch (RequestException $e) {
            $exceptionCode = $e->getCode();
            $exceptionMessage = $e->getMessage();
            //echo $e->getResponse();
        }
        catch (\Exception $e) {
            $exceptionCode = $e->getCode();
            $exceptionMessage = $e->getMessage();
        }
        finally {

        }*/
    }


}