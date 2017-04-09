<?php
namespace RestQuery\Action\Setup;

/*
 * Filters and stores optional parameters
 * TODO parameters are experimental
 */

class Load
{
    public static function Parameters() : array
    {
        $qParameters = array();

        $hintFlag = filter_input(INPUT_GET, 'hint', FILTER_VALIDATE_INT);
        if ($hintFlag == false || $hintFlag == null) {
            //do nothing, default remains at 1
        }
        if ($hintFlag == 0) {
            $qParameters[ 'enable_hinting' ] = 0;
        } else {/*do nothing, default remains at 1*/
        }

        $wildCardFlag = filter_input(INPUT_GET, 'wildcard', FILTER_VALIDATE_INT);
        if ($wildCardFlag == false || $wildCardFlag == null) {
            //do nothing, default remains at 1
        }
        if ($wildCardFlag == 0) {
            $qParameters[ 'enable_auto_wildcard' ] = 0;
        }
        else
        {/*do nothing, default remains at 1*/
        }
        return $qParameters;
    }
}