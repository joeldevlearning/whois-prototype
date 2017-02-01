<?php
namespace RestQuery\Action;
use RestQuery\Query;

class Respond {
//TODO return the proper headers here with an error message

    public static function QueryNotSupported(){
        $message = "Query is not yet supported";
        json_encode($message);
        header('Content-Type: application/json');
        echo $message;
        exit;
    }

    public static function InvalidInput(){
        $message = "The query contained invalid input.";
        json_encode($message);
        header('Content-Type: application/json');
        echo $message;
        exit;
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