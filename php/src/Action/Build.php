<?php
namespace RestQuery\Action;

use RestQuery\Query;
use RestQuery\Model\ArinConfig as config;

class Build
{

    //only supports Q1 right now
    public static function CreateUri(Query $query)
    {
        if ($query->qParameters[ 'enable_auto_wildcard' ] === 1) {
            $query->qSelectors[ 'pr' ] .= '*';
        }
        foreach ($query->qBuildQueue as $queueItem) {
            //drill down one level to reach record=>field pairs
            foreach ($queueItem as $record => $field) {
                $query->qRunQueue[] =
                    $record .
                    config::$matrixUri[ 'matrix-record-suffix' ] .
                    $field .
                    config::$matrixUri[ 'matrix-field-prefix' ] .
                    $query->qSelectors[ 'pr' ] . '*';//HACK need to check flag before adding this
            }

        }

    }

}