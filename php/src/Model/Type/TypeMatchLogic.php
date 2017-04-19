<?php

namespace RestQuery\Model\Type;

/*
 * Consider putting type matching functions in this class
 * TypeInspector is getting too big
 *
 */

use RestQuery\Action\Setup\IsEmpty;

class TypeMatchLogic
{
    public static function isIp4(string $value) : bool
    {
        if( filter_var($value, FILTER_VALIDATE_IP,FILTER_FLAG_IPV4) )
        {
            return TRUE;
        }
        //else
        return FALSE;
    }

    public static function isIp6(string $value) : bool
    {
        if( filter_var($value, FILTER_VALIDATE_IP,FILTER_FLAG_IPV6) )
        {
            return TRUE;
        }
        //else
        return FALSE;
    }

    /*
     * Don't understand Net4 or Net6 handles
     *
     */
    public static function isNet4Handle(string $value) : bool
    {
        $value = strtolower($value);
        if(substr( $value, 0, 3 ) === "net" &&
            strpos($value, ':') === FALSE
        )
        {
            /*
            //strip "NET" portion and move on
            $ipPortion = substr($value, 4);
            echo $ipPortion;
            $ipPortion = preg_replace('/[p{Pd}]/', ".", $ipPortion);
            echo $ipPortion;
            if( filter_var($ipPortion, FILTER_VALIDATE_IP,FILTER_FLAG_IPV4) )
            {
                return TRUE;
            }*/
            return TRUE;
        }
        //else
        return FALSE;
    }

    public static function isNet6Handle(string $value) : bool
    {
        $value = strtolower($value);
        if(substr( $value, 0, 3 ) === "net" &&
            strpos($value, ':') !== FALSE
        )
        {
            return TRUE;
        }
        //else
        return FALSE;
    }

    public static function isCidr4(string $value) : bool
    {
        //check for /?? ending
        $cidr = preg_replace('/(\/([0-9]|[1-2][0-9]|3[0-2]))$/', "",$value);
        if(\isEmpty($cidr))
        {
            //remove cidr portion and check if valid IP
            $value = str_replace($cidr, "", $value);
            if( filter_var($value, FILTER_VALIDATE_IP,FILTER_FLAG_IPV4) )
            {
                return TRUE;
            }
        }
        //else
        return FALSE;
    }

    public static function isCidr6(string $value) : bool
    {
        //check for /?? ending
        $cidr = preg_replace('/(\/([0-9]|[1-2][0-9]|3[0-2]))$/', "",$value);
        if(!\isEmpty($cidr))
        {
            //remove cidr portion and check if valid IP
            $value = str_replace($cidr, "", $value);
            if( filter_var($value, FILTER_VALIDATE_IP,FILTER_FLAG_IPV6) )
            {
                return TRUE;
            }
        }
        //else
        return FALSE;
    }

}
