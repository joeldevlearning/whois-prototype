<?php

namespace RestQuery\Action;

use RestQuery\Query;
use RestQuery\Action\Respond as respond;

/*
 * Checks if user input is valid for querying
 * Assigns a type the query
 */

class AnalyzeParse
{
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
    public static function IsQueryValid(Query $query)
    {
        //catch (prflag) AND (seflag) AND (prflag,seflag)
        if ($query->qSelectors[ 'pr' ] === null &&
            $query->qSelectors[ 'se' ] === null
        ) {
            respond::QueryNotSupported();
            exit;
        }
        //catch (se)
        if ($query->qSelectors[ 'pr' ] === null &&
            $query->qSelectors[ 'prflag' ] === null &&
            $query->qSelectors[ 'seflag' ] === null
        ) {
            respond::QueryNotSupported();
            exit;
        }
        //catch (prflag,se)
        if ($query->qSelectors[ 'pr' ] === null &&
            $query->qSelectors[ 'prflag' ] !== null &&
            $query->qSelectors[ 'se' ] !== null
        ) {
            respond::QueryNotSupported();
            exit;
        }
    }

    /*
  Valid query combinations are:
    a) pr (Q1)
    b) pr,prflag (Q2)
    c) pr,prflag,se (Q3)
    d) pr,prflag,se,seflag (Q4)
    e) pr,se
    f) pr,se,seflag (naive pr search, then filter by se+seflag)
    g) prflag,se,seflag (get all records of prflag type, search by se+seflag)
    h) se, seflag (e.g. all records with city=Cleveland)

    1) if pr is set, prflag,se,seflag =  null
    2) if pr,prflag are set AND se,seflag = null
    3) if pr,prflag,se are set AND seflag = null
    4) if pr,prflag,se,seflag are set
    5) if pr,se are set AND prflag,seflag = null
    6) if pr,se,seflag are set AND prflag = null
    7) if prflag,se,setflag are set AND pr = null
    8) if se,seflag are set AND pr,prflag = null

*/
    public static function WhatQueryType(Query $query)
    {
        //match (pr), Q1
        if ($query->qSelectors[ 'pr' ] !== null &&
            $query->qSelectors[ 'prflag' ] !== null &&
            $query->qSelectors[ 'se' ] === null &&
            $query->qSelectors[ 'seflag' ] === null
        ) {
            //then
            $query->qType = 1;
        } else {
            respond::QueryNotSupported();
            exit;
        }
    }


}