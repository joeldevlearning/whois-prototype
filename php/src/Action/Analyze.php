<?php
namespace RestQuery\Action;
use RestQuery\Query;
use RestQuery\Action\Respond as respond;
use RestQuery\Model\ArinModel as model;

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
        if( $query->qSelectors['pr'] === NULL &&
            $query->qSelectors['se'] === NULL ){
            respond::QueryNotSupported();
            exit;
        }
        //catch (se) 
        if( $query->qSelectors['pr'] === NULL &&
            $query->qSelectors['prflag'] === NULL &&
            $query->qSelectors['seflag'] === NULL ){
            respond::QueryNotSupported();
            exit;
        }
        //catch (prflag,se) 
        if( $query->qSelectors['pr'] === NULL &&
            $query->qSelectors['prflag'] !== NULL &&
            $query->qSelectors['se'] !== NULL ){
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
        if( $query->qSelectors['pr'] !== NULL &&
            $query->qSelectors['prflag'] === NULL &&
            $query->qSelectors['se'] === NULL &&
            $query->qSelectors['seflag'] === NULL ){
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
            echo "\nGenerating Q1... \n";
            if(!$query->qParameters['enable_hinting']){
                echo "Proceeding with hinting DISABLED... \n";
                
                $query->qBuildQueue = array(
                    0 => array('org'=>'name'),
                    1 => array('org'=>'handle'),    
                );
            }
            else{
                echo "Proceeding with hinting ENABLED.../n";
                //proceed with hints
                if($query->qParameters['enable_hinting'] === 1){
                    //identify search string as name or number
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

/*
WhatRecordsToQuery() should not contain too much nesting
consider making an enum-like structure to define endpoints
then use a dictionary to map these to specific functions

This removes configuration code from WhatRecordsToQuery() 
The function will only find the endpoint, 
lookup in the dict, 
and executes the correct function
*/

/*
Analyzer validates qSelectors
Analyzer selects qType
Analyzer reads qParameters
Analyzer selects qTarget
	- calls to ArinModelReference:LookUpTarget($constant)
		LookUpTarget() checks internal dictionary for $constant, returns array $targets
	- Analyzer pushes $targets to qBuildQueue
*/

