<?php
namespace RestQuery\Action\Validate;

/*
 * Validates combination of selectors from user input
 * To give earlier user feedback, also implement these checks on the client
 *
 */
use RestQuery\Query;

class IsValidCombination
{
    public static function IsValidSelectorCombo(array $qSelectors) : bool
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

        //catch any query with undefined pr
        if ($qSelectors[ 'pr' ] === null)
        {
            return FALSE;
        }

        //catch any query where seflag is set, but NOT se
        if ($qSelectors[ 'se' ] === null &&
            $qSelectors[ 'seflag' ] !== null
        )
        {
            return FALSE;
        }

    }



}