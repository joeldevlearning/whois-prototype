<?php
namespace RestQuery\Action;
use RestQuery\Query;

/*
This class sends headers back to the client
*/


class Respond {

    public static function QueryNotSupported(){
        $message = "Query is not yet supported";
        json_encode($message);
        header('Content-Type: application/json');
        echo $message;
    }

    /**
     * @param $q
     */
    public static function SendResults($q)
    {
        $data = json_encode($q->qTransformQueue);

//$tempJson = json_encode("hello:1");
        header('Content-Type: application/json');
        echo $data;
    }
    
}