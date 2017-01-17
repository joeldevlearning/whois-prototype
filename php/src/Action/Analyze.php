<?php
namespace Query\Action;
use Query\Query;

/*
analyze::WhatQueryType()
analyze::WhatRecordsToQuery()
analyze::WhatFieldsToQuery()
*/

class Analyze {
   
    private function walk_array_check_null($array){
        $counter = 0;
        foreach ($array as $key) {
            if(empty($key)) {
            break;
            }	
            else{
            $counter++;
            }
        return $counter;
        }
    }

    public static function WhatQueryType(Query $query){
        return walk_array_check_null($query->qElement);    
    }

}