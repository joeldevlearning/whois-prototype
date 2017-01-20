<?php
namespace RestQuery\Action;
use RestQuery\Query;
use RestQuery\Action\Respond as respond;
use RestQuery\Arin\ArinModel as model;

/*
TODO add IsCharacterType() and IsNumericType() for hinting 
*/

class Analyze {
    
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
        //catch (prflag) AND (seflag) AND (prflag,seflag)
        if( $query->qElements['pr'] === NULL && 
            $query->qElements['se'] === NULL ){
            respond::QueryNotSupported();
            exit;
        }
        //catch (se) 
        if( $query->qElements['pr'] === NULL && 
            $query->qElements['prflag'] === NULL &&
            $query->qElements['seflag'] === NULL ){
            respond::QueryNotSupported();
            exit;
        }
        //catch (prflag,se) 
        if( $query->qElements['pr'] === NULL && 
            $query->qElements['prflag'] !== NULL &&
            $query->qElements['se'] !== NULL ){
            respond::QueryNotSupported();
            exit;
        }
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
        //match (pr), Q1
        if( $query->qElements['pr'] !== NULL && 
            $query->qElements['prflag'] === NULL && 
            $query->qElements['se'] === NULL &&
            $query->qElements['seflag'] === NULL ){
        //then    
        $query->qType = 1;
        }
        else{
            respond::QueryNotSupported();
            exit;
        }
    }
    
    //TODO only works for Q1 right now
    public static function WhatRecordsToQuery(Query $query){
        switch($query->qType){

            // (pr) Q1
            case 1: 
            echo "\n Generating Q1.../n";
            if(!$query->hintFlag){
                echo "Proceeding with hinting DISABLED.../n";
                /*
                What do we know?
                We want to search each record type, using one string
                
                Step 1, what record types?
                So we need to copy the list of all record types from SOURCE to TARGET
                
                Step 2, what fields in the records?
                We wany *any* identifying <fieldset>
                So we copy the pr-all list of each record type from SOURCE to TARGET
                    asn-pr-all AND 
                    cus-pr-all
                    net-pr-all
                    org-pr-all
                    poc-pr-all

                So what have we done here?
                We have identified 5 records and ~15 fields to search
                So we have a todo list of ~15 api calls to make
        
                What's next?
                We need to know what syntax to use to 
                Then we    
                */


                //var_dump($query->qRecordList);exit; 
            }
            else{
                echo "Proceeding with hinting ENABLED.../n";
                //proceed with hints
                if($query->hintFlag === 1){
                    //identity search string as name or number
                    //foreach($query->qRecordList as $key => &$record){ }
                }
            }
            break;//end case 1
        }//end switch
    }

    //TODO empty because we are doing Q1 only now
    public static function WhatFieldsToQuery() {
        return;
    }
}