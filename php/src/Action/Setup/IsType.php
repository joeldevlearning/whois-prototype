<?php
namespace RestQuery\Action\Setup;

use Respect\Validation\Validator as v;

/*
 * Parses user input, trying to match to a type
 * Called by the Analyze class
 */

class IsType
{


    public static function AlphaNumeric(string $value) : bool
    {
        return FALSE;
    }

    public static function Ip4(string $value) : bool
    {
        if( filter_var($value, FILTER_VALIDATE_IP,FILTER_FLAG_IPV4) )
        {
            return TRUE;
        }
        //else
        return FALSE;
    }

    public static function Ip6(string $value) : bool
    {
        if( filter_var($value, FILTER_VALIDATE_IP,FILTER_FLAG_IPV6) )
        {
            return TRUE;
        }
        //else
        return FALSE;
    }

    public static function NetHandle4(string $value)
    {

    }
    public static function NetHandle6(string $value)
    {

    }
    public static function ContactHandle(string $value)
    {

    }
    public static function AsNumber(string $value)
    {

    }
    public static function CustomerNumber(string $value)
    {

    }
    public static function Email(string $value)
    {

    }
    public static function Domain(string $value)
    {

    }

}
