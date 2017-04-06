<?php
namespace RestQuery\Action\Validate;

use RestQuery\Query;
use RestQuery\Action\Respond as respond;
use Respect\Validation\Validator as v;

class IsValidString
{
    /**
     * Check length, character encoding, etc. of user input
     * @param Query $query
     * @return Query
     */
    public static function IsValidStringInput(Query $query) : bool
    {
        //create validators
        $stringFilter = v::alnum('*-')->length(1, 101); //allow * and - characters
        $flagFilter = v::alnum()->length(1, 40);

        //v::key accepts @param key name AND validator
        if ($query->qSelectors[ 'pr' ] !== null &&
            v::key('pr', $stringFilter)->validate($query->qSelectors) === false)
        {
            return FALSE;
        }
        if ($query->qSelectors[ 'se' ] !== null &&
            !v::key('se', $stringFilter)->validate($query->qSelectors)
        )
        {
            return FALSE;
        }

        if ($query->qSelectors[ 'prflag' ] !== null &&
            !v::key('prflag', $flagFilter)->validate($query->qSelectors)
        )
        {
            return FALSE;
        }

        if ($query->qSelectors[ 'seflag' ] !== null &&
            !v::key('seflag', $flagFilter)->validate($query->qSelectors)
        )
        {
            //error, bad input
            return FALSE;
        }
        return TRUE;
    }
}