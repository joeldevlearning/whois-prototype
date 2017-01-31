<?php

namespace RestQuery\Action;
use RestQuery\Query;

class BuildStringHelper
{
    /*
     * Rules for Wildcards in RWS
     * Rule #1, Wildcards are allowed at the end of strings
     * EXAMPLE "org/Appl*"
     *
     * Rule #2, Wildcards are allowed within a string
     * EXAMPLE "orgs;name=app*e" is allowed
     *
     * Rule #3, Multiple wildcards are allowed within a string
     * EXAMPLE "orgs;name=app**" is allowed
     *
     * Rule #4, wildcards are not allowed within the middle of the /RECORD/HANDLE/RECORD syntax
     * EXAMPLE "org/ari[*]/poc" is NOT allowed
     */
    public static function HasEndingWildCard(Query $query) {

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
}