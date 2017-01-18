<?php
namespace RestQuery\Action;
use RestQuery\Query;
use RestQuery\Action\Respond as respond;

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
    * TODO, given the above combinations, we need a new way to determine query type
    */
    public static function OldWhatQueryType(Query $query){
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
    
    
    /*
      Valid query combinations are:  
        a) pr (Q1)
        b) pr,prflag (Q2)
        c) pr,prflag,se (Q3) 
        d) pr,prflag,se,seflag (Q4)
        e) pr,se
        f) pr,se,seflag (naive pr search, then filter by se+seflag)
        g) prflag,se,seflag (get all records of prflag type, search by se+seflag)
        h) se, seflag (e.g. all records with city=Cleveland)

1) if pr is set, prflag,se,seflag =  null        
2) if pr,prflag are set AND se,seflag = null
3) if pr,prflag,se are set AND seflag = null
4) if pr,prflag,se,seflag are set
5) if pr,se are set AND prflag,seflag = null
6) if pr,se,seflag are set AND prflag = null
7) if prflag,se,setflag are set AND pr = null
8) if se,seflag are set AND pr,prflag = null

    */
    public static function WhatQueryType(Query $query){
        //underlying data structure is bad 
        //need to fix so that we can accept different query combinations
        
        //match (pr), Q1
        if( $query->qElement['pr'] !== NULL && 
            $query->qElement['prflag'] === NULL && 
            $query->qElement['se'] === NULL &&
            $query->qElement['seflag'] === NULL ){
            //do something
        }
        else{
            respond::QueryNotSupported();
            exit;
        }

        //$query->qType = 1;
        //echo $query->qType; 
    }
    
    //TODO return the proper headers here with an error message
    /*Invalid query combinations are:
        a) se (would have to assume that this is pr; bad assumption)
        b) prflag (no search string)
		c) seflag (no string search)
		d) prflag,seflag (no search string) 
        e) pr,seflag (would have to assume seflag is prflag OR pr is really se; bad assumptions)
		f) prflag,se (would have to assume se is pr OR prflag is seflag; bad assumptions)

    We can use the following four filters:
        - if pr and se are null (catches b,c,d)
        - if everything but se is null (catches a)
        - if seflag is set BUT se is null (catches e)
        - if prflag is set BUT pr is null AND se is set (catches f)  
    */
    public static function IsQueryValid(Query $query){
        if($query->qType !== 1){
            respond::QueryNotSupported();
            exit;
        }
        //catch (prflag) AND (seflag) AND (prflag,seflag)
        if( $query->qElement['pr'] === NULL && 
            $query->qElement['se'] === NULL ){
            respond::QueryNotSupported();
            exit;
        }
        //catch (se) 
        if( $query->qElement['pr'] === NULL && 
            $query->qElement['prflag'] === NULL &&
            $query->qElement['seflag'] === NULL ){
            respond::QueryNotSupported();
            exit;
        }
        //catch (prflag,se) 
        if( $query->qElement['pr'] === NULL && 
            $query->qElement['prflag'] !== NULL &&
            $query->qElement['se'] !== NULL ){
            respond::QueryNotSupported();
            exit;
        }
    }

    //TODO only works for Q1 right now
    //TODO the if() logic will have to change to accomodate more query combinations
    public static function WhatRecordsToQuery(Query $query){
        if($query->qType === 1){
            //continue
        }
        else{
        exit;    
        }

    }

    //TODO empty because we are doing Q1 only now
    public static function WhatFieldsToQuery() {
        return;
    }
}