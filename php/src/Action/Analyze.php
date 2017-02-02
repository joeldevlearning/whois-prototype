<?php
namespace RestQuery\Action;

use RestQuery\Query;
use RestQuery\Action\{
    AnalyzeLookUp as lookup, AnalyzeParse as parse
};

/*
TODO add IsCharacterType() and IsNumericType() for hinting 
*/

class Analyze
{
    /**
     * Convenience method, sends rejection to client if query format cannot be used
     * @param Query $query
     */
    public static function ParseQuery(Query $query)
    {
        parse::IsQueryValid($query);
    }

    /**
     * Convenience method, gives number to $q->qType, later used to generate calls to RWS
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
