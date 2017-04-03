<?php
namespace RestQuery\Action;

use RestQuery\Query;
use RestQuery\Action\{AnalyzeLookUp as lookup, AnalyzeParse as parse};

/*
 *
 *  * The Analyze action reconciles user input with the whois-rws api

 * The Analyze action decides what queries to run against whois
 * It does this in three steps:
 *  - Assigning type data to queries, via AssignType and helpers
 *  - identifying what fields to query
 *  - identifying what records contain query said fields
 *
 New function names:
 *  - AnalyzeAssignType
 *  - AnalyzeMatchField
 *  - AnalyzeMatchRecord
 *  - AnalyzeCreateExpression
 *
 *
*/

class Analyze
{
    /*
     * Wrapper method, parses user input and wraps it in an object derived from AbstractType
     *
     * @param Query $query
     *
     * WHAT ARE TYPES FOR?
     * types allow us to match user input against fields in ARIN's model
     * ARIN has no formal types, just database fields exposed via json/xml
     * we assign types so that we can abstract our logic from arin's model
     */

    public static function AssignType(Query $query)
    {

    }

    /**
     * Wrapper method, gives number to $q->qType, later used to generate calls to RWS
     * @param Query $query
     */
    public static function SelectQueryType(Query $query)
    {
        parse::WhatQueryType($query);
    }

    //TODO only works for Q1 right now
    public static function WhatRecordsToQuery(Query $query)
    {
        $lookup = new lookup(); //call AnalyzeLookUp class

        switch ($query->qType) {

            case 1: // pr only
                if (!$query->qParameters[ 'enable_hinting' ]) {
                    switch ($query->qSelectors[ 'prflag' ]) {

                        case 'org':
                            $query->qBuildQueue = $lookup->LookUpRecordField('ORG_RECORDS_HINT_NAME');
                            break;//must break to avoid default
                        default:
                            $query->qBuildQueue = $lookup->LookUpRecordField('ALL_RECORDS_HINT_NAME');
                    }
                } else {
                    if ($query->qParameters[ 'enable_hinting' ] === 1) {
                        //add custom validator for name/number type
                        //should correspond to possible rules for all record types
                        //foreach($query->qRecordList as $key => &$record){ }
                    }
                }
                break;//end case 1
            default: //should never reach here

        }//end switch
    }

}
