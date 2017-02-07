<?php
namespace RestQuery\Action;

/*
 * Validates combination of selectors from user input
 * To give earlier user feedback, also implement these checks on the client
 *
 */
use RestQuery\Query;
use RestQuery\Action\Respond as respond;

class CleanValidate
{

    public function __invoke(Query $query)
    {
        $this->validateSelectorCombo($query);

    return $query;
    }

    private function validateSelectorCombo($query)
    {
        /*Invalid query combinations are:
        a) se (would have to assume that this is pr; bad assumption)
        b) prflag (no search string)
        c) seflag (no string search)
        d) prflag,seflag (no search string)
        e) pr,seflag (would have to assume seflag is prflag OR pr is really se; bad assumptions)
        f) prflag,se (would have to assume se is pr OR prflag is seflag; bad assumptions)
        g) se,seflag (cannot search most fields directly; need pr to get a set of records to search)

        We can use the following four filters:
        - if pr is null (catches a,b,c,d,f,g)
        - if pr and se are null (catches b,c,d) //TODO seems redundant with pr=null check
        - if everything but se is null (catches a) //TODO seems redundant with pr=null check
        - if seflag is set BUT se is null (catches e)
        - if prflag is set BUT pr is null AND se is set (catches f) //TODO seems redundant with pr=null check

        */
        if ($query->qSelectors[ 'pr' ] === null) //TODO this seems to make most checks redundant, see below
        {
            respond::QueryNotSupported();
            exit;
        }

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
    }



}