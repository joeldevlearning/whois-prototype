<?php
namespace RestQuery\Action;
use RestQuery\Query;

/*
TODO add IsCharacterType() and IsNumericType() for hinting 
*/

class Analyze {

    /*
    *
    * NOTE: We break the loop like this becaus right now only FOUR sets have meaning
    * (pr) OR (pr+prflag) OR (pr,prflag,se) OR (pr,prflag,se,seflag)
    * order is NOT important
    * TODO consider expanding the number of meaningful query sets (out of ~14? total)    
    * consider the following sets as VALID: 
        - pr (Q1)
        - pr,prflag (Q2)
        - pr,prflag,se (Q3) 
        - pr,prflag,se,seflag (Q4)
        - pr,se
        - pr,se,seflag (naive pr search, then filter by se+seflag)
        - prflag,se,seflag (get all records of prflag type, search by se+seflag)
        - se, seflag (e.g. all records with city=Cleveland)

    * INVALID sets are:
        - se (would have to assume that this is pr; bad assumption)
        - prflag (no search string)
		- seflag (no string search)
		- prflag,seflag (no search string) 
        - pr,seflag (would have to assume seflag is prflag OR pr is really se; bad assumptions)
		- prflag,se (would have to assume se is pr OR prflag is seflag; bad assumptions)	
    *
    * TODO, given the above combinations, we need a new way to determine query type
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