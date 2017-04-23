<?php

namespace RestQuery\Action\Process;

use RestQuery\Query;

class Compose
{
    public static function Queryable(Query $query)
    {
        $targetList = array();
        /*
         * should getTarget be trait that reads expression?
         * or should we just call expression directly?
         * any value to indirection of using trait?
         *
         */

        foreach ($targetList as $item) {
            $record = $targetList[ $item ][ 'record' ];
            $field = $targetList[ $item ][ 'field' ];
            $format = $targetList[ $item ][ 'format' ];

            switch ($format) {
                default: //'url-matrix'
                    $recordSuffix = "s;";
                    $fieldPrefix = "=";
            }

            $apiString = $record . $recordSuffix . $fieldPrefix . $field;

            /*
             * for right now store in runqueue
             * but really we want to create a queryable here and store it
             */
            $query->qRunQueue[] = $apiString;
        }
    }
}






}