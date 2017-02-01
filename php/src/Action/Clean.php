<?php
namespace RestQuery\Action;

use RestQuery\Query;
use RestQuery\Action\Respond as respond;
use Respect\Validation\Validator as v;

class Clean
{
    public static function ValidateInput(Query $query)
    {
        //create validators
        $stringFilter   = v::alnum('*-')->length(1, 101); //allow * and - characters
        $flagFilter     = v::alnum()->length(1, 40);

        if( $query->qSelectors['pr'] !== NULL ) {
            //v::key accepts @param key name AND validator
            if( v::key('pr', $stringFilter)->validate($query->qSelectors) === FALSE ) {
                //error, bad input
                respond::InvalidInput();
            }
        }
        if( $query->qSelectors['se'] !== NULL ) {
            if(! v::key('se', $stringFilter)->validate($query->qSelectors) ) {
                //error, bad input
                respond::InvalidInput();
            }
        }
        if( $query->qSelectors['prflag'] !== NULL ) {
            if(! v::key('prflag', $flagFilter)->validate($query->qSelectors) ) {
                //error, bad input
                respond::InvalidInput();
            }
        }
        if( $query->qSelectors['seflag'] !== NULL ) {
            if(! v::key('seflag', $flagFilter)->validate($query->qSelectors) ) {
                //error, bad input
                respond::InvalidInput();
            }
        }
    }




    public static function OldValidate(Query $query)
    {
        $prTemp = $query->qSelectors['pr'];
        $prFlagTemp = $query->qSelectors['prflag'];
        $srTemp = $query->qSelectors['se'];
        $srFlagTemp = $query->qSelectors['seflag'];

        $searchStringValidator = v::stringType()->length(1, 255);
        $recordFlagStringValidator = v::stringType()->length(1, 12);

        $isPrimarySearchValid = $searchStringValidator->validate($prTemp);
        $isPrimaryFlagValid = $recordFlagStringValidator->validate($prFlagTemp);
        $isSecondarySearchValid = $searchStringValidator->validate($srTemp);
        $isSecondaryFlagValid = $recordFlagStringValidator->validate($srFlagTemp);
    
        if ($isPrimarySearchValid == FALSE) {
            $query->qSelectors['pr']  = NULL; //magic null value
        }

        if ($isPrimaryFlagValid == FALSE) {
            $query->qSelectors['prflag']  = NULL; //magic null value
        }

        if ($isSecondarySearchValid == FALSE) {
            $query->qSelectors['se']  = NULL; //magic null value
        }

        if ($isSecondaryFlagValid == FALSE) {
            $query->qSelectors['seflag']  = NULL; //magic null value
        }
    }
}
