<?php
namespace RestQuery\Action;
use RestQuery\Query;

class Analyze {

    /*
    *
    * Why break the foreach loop naively like this?
    * Because only FOUR sets have meaning
    * (pr) OR (pr+prflag) OR (pr,prflag,se) OR (pr,prflag,se,seflag)
    * Note that order is NOT important
    * TODO consider making (pr,se) a valid combination
    */
    public static function WhatQueryType(Query $query){
        $counter = 0;
        foreach ($query->qElements as $key) {
            if(is_null($key)) {
            break;    
            }	
            else{
            echo "not empty!";
            $counter++;
            }
        }
        $query->qType = $counter;
        echo $query->qType; 
    }

    //TODO return the proper headers here with an error message
    public static function IsQueryValid(Query $query){
        if($query->qType === 0){
            exit;
        }
        else{
            return;
        }
    }

    //only works for Q1 right now
    public static function WhatRecordsToQuery(Query $query){


    }

    //empty because we are doing Q1 only now
    public static function WhatFieldsToQuery() {
        return;
    }
}