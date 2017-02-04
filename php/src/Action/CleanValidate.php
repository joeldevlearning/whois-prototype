<?php
namespace RestQuery\Action;

use RestQuery\Query;
use RestQuery\Action\Respond as respond;

class CleanValidate
{

    public function __invoke(Query $query)
    {
        //catch sets (prflag) AND (seflag) AND (prflag,seflag)
        if ($query->qSelectors[ 'pr' ] === null &&
            $query->qSelectors[ 'se' ] === null
        ) {
            respond::QueryNotSupported();
            exit;
        }
        //catch set (se)
        if ($query->qSelectors[ 'pr' ] === null &&
            $query->qSelectors[ 'prflag' ] === null &&
            $query->qSelectors[ 'seflag' ] === null
        ) {
            respond::QueryNotSupported();
            exit;
        }
        //catch set (prflag,se)
        if ($query->qSelectors[ 'pr' ] === null &&
            $query->qSelectors[ 'prflag' ] !== null &&
            $query->qSelectors[ 'se' ] !== null
        ) {
            respond::QueryNotSupported();
            exit;
        }
    return $query;
    }

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

}