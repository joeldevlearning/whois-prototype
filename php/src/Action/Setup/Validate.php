<?php

namespace RestQuery\Action\Setup;

/*
 * Validates combination of selectors from user input
 *
 */
use RestQuery\Exception\QueryCombinationWasInvalid;
use RestQuery\Query;
use Respect\Validation\Validator as v;
use RestQuery\Action\Setup\IsEmpty;
use RestQuery\Exception\QueryInputWasInvalid;

class Validate
{
    public static function allInput($qSelectors)
    {
            if (self::content($qSelectors) === FALSE ||
                self::flag($qSelectors) === FALSE
            )
            {
                throw new QueryInputWasInvalid("Validation failed: Bad string input.");
            }

            if(self::combination($qSelectors) === FALSE)
            {
                throw new QueryCombinationWasInvalid("Validation failed: Bad combination of input variables.");
            }
    }

    /**
     * Check length, character encoding, etc. of user input
     * @param Query $query
     * @return Query
     */
    public static function content(array $qSelectors): bool
    {
        $stringFilter = v::alnum('*-.:')->length(1, 101); //allow * and - characters

        if (IsEmpty::string($qSelectors[ 'pr' ]) &&
            v::key('pr', $stringFilter)->validate($qSelectors) === false
        ) {
            return false;
        }

        if (!IsEmpty::string($qSelectors[ 'se' ])) //if se exists
        {
            if (v::key('se', $stringFilter)->validate($qSelectors) === false) {
                return false;
            }
        }
        return true;
    }

    public static function flag(array $qSelectors)
    {
        $flagFilter = v::alnum()->length(1, 40);

        if (!IsEmpty::string($qSelectors[ 'prflag' ]))
        {
            if (v::key('prflag', $flagFilter)->validate($qSelectors) === FALSE)
            {
                return FALSE;
            }
        }

        if (!IsEmpty::string($qSelectors[ 'seflag' ]))
        {
            if (v::key('seflag', $flagFilter)->validate($qSelectors) === FALSE)
            {
                return FALSE;
            }
        }
        return true;
    }

    public static function combination(array $qSelectors): bool
    {
        /**
         * Invalid query combinations are:
         * a) se (would have to assume that this is pr; bad assumption)
         * b) prflag (no search string)
         * c) seflag (no string search)
         * d) prflag,seflag (no search string)
         * e) pr,seflag (would have to assume seflag is prflag OR pr is really se; bad assumptions)
         * f) prflag,se (would have to assume se is pr OR prflag is seflag; bad assumptions)
         * g) se,seflag (cannot search most fields directly; need pr to get a set of records to search)
         *
         * We can use the following filters:
         * - if pr is null (catches a,b,c,d,f,g)
         * - if seflag is set BUT se is null (catches e)
         */

        //pr MUST be set
        if ($qSelectors[ 'pr' ] === NULL) {
            return false;
        }

        //seflag requires se to be set
        if ($qSelectors[ 'seflag' ] !== NULL &&
            $qSelectors[ 'se' ] === NULL
        ) {
            return false;
        }
        return true;
    }
}