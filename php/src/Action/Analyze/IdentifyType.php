<?php
namespace RestQuery\Action\Analyze;

use RestQuery\Query;

/*
 * Parses user input, trying to match to a type
 * Called by the Analyze class
 */

class IdentifyType
{
    public function MatchToType(Query $query) : object
    {

        /*
         * call all the functions in sets
         * look for most common cases first
         * then less obvious
         *
         * if( ConditionMethod(a) &&
               ConditionMethod(b) &&
           ConditionMethod(c))
            {

            }
         *
         */
    }

    private function IsAlphaNumeric()
    {

    }

    private function IsIp(string $value)
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
    private function IsIp6($value)
    {
        if( filter_var($value, FILTER_VALIDATE_IP,FILTER_FLAG_IPV6) )
        {
            return TRUE;
        }
        //else
        return FALSE;
    }

}
