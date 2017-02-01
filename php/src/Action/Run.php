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
                ['headers' => ['Accept' => 'application/json']]//HACK default json not working, repeat here
            );

            $promise->then(
                function (ResponseInterface $res) {
                    //echo "Host: ".$res->getRequest()->getUri()->getHost(), "\n";
                    //echo "Path: ".$res->getRequest()->getRequestTarget(), "\n";
                },
                function (RequestException $e) {
                    //echo "Host: ".$e->getRequest()->getUri()->getHost(), "\n";
                    echo "Path: ".$e->getRequest()->getRequestTarget(), '<br>';
                }
            );

            array_push($promisesArrayOf, $promise);
        }
        return $promisesArrayOf;
    }

    /**
     * @param $promisesArrayOf
     */
    public static function StorePromiseResults(Query $q, array $promisesArrayOf)
    {
        //try {
            $rawResultsArrayOf = Promise\unwrap($promisesArrayOf);//wait for all promises passed to resolve, then unwrap
            $finalResultsArrayOf = array();

            foreach ($rawResultsArrayOf as $key => $queryResult) {
                array_push($q->qTransformQueue, $rawResultsArrayOf[$key]->getBody()->getContents());
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