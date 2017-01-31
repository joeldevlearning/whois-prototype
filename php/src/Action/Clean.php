<?php
namespace RestQuery\Action;

use RestQuery\Query;
use Respect\Validation\Validator as v;

class Clean
{
    /**
    * Populates Query object with filtered, validated input
    *
    * @param mixed[] $_GET The superglobal is implicitly passed
    * @param object $query Passed a new instance of Query
    *
    * @return object $query Returned with $qSelectors populated
    */

    public static function FilterJunk(Query $query)
    {
        //do simple validation check
        //if not alnum (including - and *), then fail
        $stringFilter = v::alnum('*-')->length(1, 150);
        $flagFilter =v::alnum()->length(1, 40);

        //else, check for wildcards
        //if only ONE wildcard at end, no problem
        //else remove wildcard

        //

        //$recordFieldFilter

        //@param key name, validator to apply
        v::key('pr', $stringFilter)->validate($query->qSelectors['pr']);
        v::key('se', $stringFilter)->validate($query->qSelectors['se']);

        //if not alnum, remove all non-alnum characters
        //if more than 150 characters, truncate

        //if validator passes, handle wildcards
        //if validator fails, remove special
    }


    public static function HandleWildCard(Query $query) {

        /*Bad condition is if there is */
        if ( isset($query->qSelectors['pr']) ) {
            if ( strpos($query->qSelectors['pr'], '*') !== FALSE) {
                //if exists, check if it is at end
                if ( substr($query->qSelectors['pr'], -1) === '*') {
                    //last character is *, do nothing
                }
                else {
                    //another character must be *, needs to be cleaned
                }
            }
        }
    }


    public static function Validate(Query $query)
    {
        $prTemp = $query->qSelectors['pr'];
        $prFlagTemp = $query->qSelectors['prflag'];
        $srTemp = $query->qSelectors['se'];
        $srFlagTemp = $query->qSelectors['seflag'];

        $searchStringValidator = validate::stringType()->length(1, 255);
        $recordFlagStringValidator = validate::stringType()->length(1, 12);

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
