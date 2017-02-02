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
        $stringFilter = v::alnum('*-')->length(1, 101); //allow * and - characters
        $flagFilter = v::alnum()->length(1, 40);

        if ($query->qSelectors[ 'pr' ] !== null) {
            //v::key accepts @param key name AND validator
            if (v::key('pr', $stringFilter)->validate($query->qSelectors) === false) {
                //error, bad input
                respond::InvalidInput();
            }
        }
        if ($query->qSelectors[ 'se' ] !== null) {
            if (!v::key('se', $stringFilter)->validate($query->qSelectors)) {
                //error, bad input
                respond::InvalidInput();
            }
        }
        if ($query->qSelectors[ 'prflag' ] !== null) {
            if (!v::key('prflag', $flagFilter)->validate($query->qSelectors)) {
                //error, bad input
                respond::InvalidInput();
            }
        }
        if ($query->qSelectors[ 'seflag' ] !== null) {
            if (!v::key('seflag', $flagFilter)->validate($query->qSelectors)) {
                //error, bad input
                respond::InvalidInput();
            }
        }
    }


    public static function OldValidate(Query $query)
    {
        $prTemp = $query->qSelectors[ 'pr' ];
        $prFlagTemp = $query->qSelectors[ 'prflag' ];
        $srTemp = $query->qSelectors[ 'se' ];
        $srFlagTemp = $query->qSelectors[ 'seflag' ];

        $searchStringValidator = v::stringType()->length(1, 255);
        $recordFlagStringValidator = v::stringType()->length(1, 12);

        $isPrimarySearchValid = $searchStringValidator->validate($prTemp);
        $isPrimaryFlagValid = $recordFlagStringValidator->validate($prFlagTemp);
        $isSecondarySearchValid = $searchStringValidator->validate($srTemp);
        $isSecondaryFlagValid = $recordFlagStringValidator->validate($srFlagTemp);

        if ($isPrimarySearchValid == false) {
            $query->qSelectors[ 'pr' ] = null; //magic null value
        }

        if ($isPrimaryFlagValid == false) {
            $query->qSelectors[ 'prflag' ] = null; //magic null value
        }

        if ($isSecondarySearchValid == false) {
            $query->qSelectors[ 'se' ] = null; //magic null value
        }

        if ($isSecondaryFlagValid == false) {
            $query->qSelectors[ 'seflag' ] = null; //magic null value
        }
    }
}
