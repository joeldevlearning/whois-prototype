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
    /**
     * Wrapper method, gives number to $q->qType, later used to generate calls to RWS
     * @param Query $query
     */
    //TODO probably do not need this method
    public static function SelectQueryType(Query $query)
    {
        parse::WhatQueryType($query);
    }

    //TODO only works for ORG or ALL right now
    public static function WhatRecordsToQuery(Query $query)
    {
        $lookup = new lookup(); //call AnalyzeLookUp class

        if ($query->getPrimary()->getFlag() === 'org')
        {
            $query->qBuildQueue = $lookup->LookUpRecordField('ORG_RECORDS_HINT_NAME');
        }
        else
        {
            $query->qBuildQueue = $lookup->LookUpRecordField('ALL_RECORDS_HINT_NAME');
        }

    }

}
