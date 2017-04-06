<?php
namespace RestQuery\Action\Analyze;

use RestQuery\Query;
use Respect\Validation\Validator as v;

/*
 * Parses user input, trying to match to a type
 * Called by the Analyze class
 */

class IdentifyType
{
    public static function Identify(string $value) : object
    {

        /*
         * AlphaNumeric was confirmed true in Sanitize action
         * now check for more specific types of AlphaNumeric
         */
        if( IsNetHandle4() )
        {}

        if( IsNetHandle6() )
        {}

        if( IsContactHandle() )
        {}

        if( IsAsNumber() )
        {}

        if( IsCustomerNumber() )
        {}

        if( IsEmail() )
        {}

        //if( HasDomain() ) {}

        if( IsIp() &&
            !IsIp6()
        )
        {
            //must be ip4
        }
            elseif( IsIp6() )
            {
                //must be ip6
            }

        if( IsCidr() )
        {}

    }

    private function IsIp(string $value) : bool
    {
        //true for valid IPV4 and IPV6
        if( filter_var($value, FILTER_VALIDATE_IP) )
        {
            return TRUE;
        }
        //else
            return FALSE;
    }

    //skip ip4 check; if it's an IP and NOT ip6, then it MUST be ip4
    private function IsIp6($value) : bool
    {
        if( filter_var($value, FILTER_VALIDATE_IP,FILTER_FLAG_IPV6) )
        {
            return TRUE;
        }
        //else
        return FALSE;
    }

}
