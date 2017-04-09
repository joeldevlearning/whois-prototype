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
    public static function GetParameters() : array
    {
        $qSelectors = [
            "pr"      => array("rawString" => filter_input(INPUT_GET, 'pr', FILTER_SANITIZE_FULL_SPECIAL_CHARS)),
            "prflag"  => array("rawString" => filter_input(INPUT_GET, 'prflag', FILTER_SANITIZE_FULL_SPECIAL_CHARS)),
            "se"      => array("rawString" => filter_input(INPUT_GET, 'se', FILTER_SANITIZE_FULL_SPECIAL_CHARS)),
            "seflag"  => array("rawString" => filter_input(INPUT_GET, 'seflag', FILTER_SANITIZE_FULL_SPECIAL_CHARS)),
        ];
        return $qSelectors;
    }
}