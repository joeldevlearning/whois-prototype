<?php
namespace RestQuery\Action;

/*
 * TODO maybe change this to "Format" class
 * TODO CreateUri($query) would read better as Serialize($query)
 * TODO Serialize can change its formatter based on Target->getType() and getFormat() (strategy pattern)
 */
use RestQuery\Query;
use RestQuery\Model\ArinConfig as config;

class Build
{
    //only supports Q1 right now
    public static function CreateUri(Query $query)
    {
        foreach ($query->qBuildQueue as $queueItem) {
            //drill down one level to reach record=>field pairs
            foreach ($queueItem as $record => $field) {
                $query->qRunQueue[] =
                    $record .
                    config::$matrixUri[ 'matrix-record-suffix' ] .
                    $field .
                    config::$matrixUri[ 'matrix-field-prefix' ] .
                    $query->getPrimary()->getValue() . '*';//HACK need to check flag before adding this
            }

        }

    }

    public static function CreateUriFixed(Query $query)
    {
        $prSelector = $query->getPrimary()->getValue();
        $prSelector .= '*';
        $query->qRunQueue = array(
            'orgs;name=' . $prSelector,
            'pocs;name=' . $prSelector,
            'customers;name='  . $prSelector,
            'nets;name='  . $prSelector,
            'asns;name='  . $prSelector
        );
    }

}
