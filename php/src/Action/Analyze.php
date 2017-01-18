<?php
namespace RestQuery\Action;
use RestQuery\Query;

/*
analyze::WhatRecordsToQuery()
analyze::WhatFieldsToQuery()
*/

class Analyze {

    public static function WhatQueryType(Query $query){
        $counter = 0;
        foreach ($query->qElements as $key) {
            if(empty($key)) {
            break;
            }	
            else{
            $counter++;
            }
        return $counter;
        }
        $query->qType = $counter;
        print_r(qElements);    
    }

    public static function WhatRecordsToQuery(){

        
    }

}