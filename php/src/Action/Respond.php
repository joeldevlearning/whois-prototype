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

    public static function Results($data){
        //$dataJson = json_encode($data);
        header('Content-Type: application/json');
        echo $data;
    }
    
}