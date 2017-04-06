<?php
namespace RestQuery\Action\Validate;

/*
 * Validates combination of selectors from user input
 *
 */
use RestQuery\Query;
use Respect\Validation\Validator as v;

class IsValidString
{
    /**
     * Check length, character encoding, etc. of user input
     * @param Query $query
     * @return Query
     */
    public static function IsValidStringInput(array $qSelectors) : bool
    {
        //create validators
        $stringFilter = v::alnum('*-')->length(1, 101); //allow * and - characters
        $flagFilter = v::alnum()->length(1, 40);

        //v::key accepts @param key name AND validator
        if ($qSelectors[ 'pr' ][ 'rawString' ] !== null &&
            //dot syntax indicates nested key
            v::keyNested('pr.rawString', $stringFilter)->validate($qSelectors) === false)
        {
            return FALSE;
        }
        if ($qSelectors[ 'se' ][ 'rawString' ] !== null &&
            !v::keyNested('se.rawString', $stringFilter)->validate($qSelectors)
        )
        {
            return FALSE;
        }

        if ($qSelectors[ 'prflag' ][ 'rawString' ] !== null &&
            !v::keyNested('prflag.rawSting', $flagFilter)->validate($qSelectors)
        )
        {
            return FALSE;
        }

        if ($qSelectors[ 'seflag' ][ 'rawString' ] !== null &&
            !v::keyNested('seflag.rawString', $flagFilter)->validate($qSelectors)
        )
        {
            return FALSE;
        }
        return TRUE;
    }
}