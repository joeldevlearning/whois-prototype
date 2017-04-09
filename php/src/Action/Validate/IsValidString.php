<?php
namespace RestQuery\Action\Validate;

/*
 * Validates combination of selectors from user input
 *
 */
use RestQuery\Query;
use Respect\Validation\Validator as v;
use RestQuery\Exception\QueryInputWasInvalid;

class IsValidString
{
    /**
     * Check length, character encoding, etc. of user input
     * @param Query $query
     * @return Query
     */
    public static function IsValidSearchString(array $qSelectors) : bool
    {
        $stringFilter = v::alnum('*-')->length(1, 101); //allow * and - characters

        if ($qSelectors[ 'pr' ][ 'rawString' ] === null &&

            v::keyNested('pr.rawString', $stringFilter)->validate($qSelectors) === false)
        {
            return FALSE; //return false
        }

        if($qSelectors[ 'se' ][ 'rawString' ]) //if se exists
        {
            if ($qSelectors[ 'se' ][ 'rawString' ] === null ||
                !v::keyNested('se.rawString', $stringFilter)->validate($qSelectors)
            )
            {
                return FALSE; //return false
            }
        }
        return TRUE;
    }

    public static function IsValidFlag(array $qSelectors)
    {
        $flagFilter = v::alnum()->length(1, 40);

        if($qSelectors[ 'prflag' ][ 'rawString' ])
        {
            if ($qSelectors[ 'prflag' ][ 'rawString' ] === null ||
                !v::keyNested('prflag.rawSting', $flagFilter)->validate($qSelectors)
            ) {
                return FALSE; //return false
            }
        }

        if($qSelectors[ 'seflag' ][ 'rawString' ])
        {
            if ($qSelectors[ 'seflag' ][ 'rawString' ] === null ||
                !v::keyNested('seflag.rawString', $flagFilter)->validate($qSelectors)
            ) {
                return FALSE; //return false
            }
        }
        return TRUE;
    }
}