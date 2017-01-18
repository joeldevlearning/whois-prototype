<?php
namespace RestQuery\Action;
use RestQuery\Query;

class Analyze {

    /*
    *
    * Why break the loop naively like this?
    * Because only FOUR sets have meaning
    * var1 OR var1+var2 OR var1+var2+var3 OR var1+var2+var3+var4
    * Note that order is NOT important
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

    //only works for Q1 right now
    public static function WhatRecordsToQuery(Query $query){


    }

    //empty because we are doing Q1 only now
    public static function WhatFieldsToQuery() {
        return;
    }
}