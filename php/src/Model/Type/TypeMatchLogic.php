<?php

namespace RestQuery\Model\Type;

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
        $ipOnly = preg_replace('/(\/([0-9]|[1-2][0-9]|3[0-2]))$/', "",$value);
        $cidr = str_replace($ipOnly, "", $value);
        if(!isEmpty::string($cidr))
        {
            //remove cidr portion and check if valid IP
            if( filter_var($ipOnly, FILTER_VALIDATE_IP,FILTER_FLAG_IPV4) )
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
        $ipOnly = preg_replace('/(\/([0-9]|[1-2][0-9]|3[0-2]))$/', "", $value);
        $cidr = str_replace($ipOnly, "", $value);
        if (!isEmpty::string($cidr))
        {
            //remove cidr portion and check if valid IP
            if (filter_var($ipOnly, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                return TRUE;
            }
        }
        //else
        return FALSE;
    }

    public static function isAsNumber(string $value) : bool
    {
        $value = strtolower($value);
        if(substr( $value, 0, 2 ) === "as")
        {
            $noAs = str_replace('as', "", $value);
            if(preg_replace('/[^0-9]/', "", $noAs))
            {
                return TRUE;
            }
        }
        //else
        return FALSE;
    }

    public static function isCustomerNumber(string $value) : bool
    {
        $value = strtolower($value);
        if(substr( $value, 0, 1 ) === "c")
        {
            $noC = str_replace('as', "", $value);
            if(preg_replace('/[^0-9]/', "", $noC))
            {
                return TRUE;
            }
        }
        //else
        return FALSE;
    }

    public static function isEmailDomain(string $value) : bool
    {
        //TODO
        return FALSE;
    }

    public static function isPocHandle(string $value) : bool
    {
        //TODO
        return FALSE;
    }

    public static function isNumeric(string $value) : bool
    {
        if(preg_replace('/[0-9]/', "", $value) === '')
        {
            return TRUE;
        }
        //else
        return FALSE;
    }

}
