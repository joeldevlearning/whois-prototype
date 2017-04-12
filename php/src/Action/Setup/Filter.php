<?php
/*
 * Sanitize "special" characters
 * Wrapper for PHP's built-in filter_input()
 *
 */
namespace RestQuery\Action\Setup;


class Filter
{
    //Filter() returns qSelector array with [pr][rawString]
    public static function httpGetSelectors() : array
    {
        $qSelectors = [
            "pr"      => array("rawString" => filter_input(INPUT_GET, 'pr', FILTER_SANITIZE_FULL_SPECIAL_CHARS)),
            "prflag"  => array("rawString" => filter_input(INPUT_GET, 'prflag', FILTER_SANITIZE_FULL_SPECIAL_CHARS)),
            "se"      => array("rawString" => filter_input(INPUT_GET, 'se', FILTER_SANITIZE_FULL_SPECIAL_CHARS)),
            "seflag"  => array("rawString" => filter_input(INPUT_GET, 'seflag', FILTER_SANITIZE_FULL_SPECIAL_CHARS)),
        ];
        return $qSelectors;
    }

    public static function httpGetParameters() : array
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