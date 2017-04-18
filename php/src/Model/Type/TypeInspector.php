<?php

namespace RestQuery\Model\Type;

use RestQuery\Exception\TypeCheckFunctionDoesNotExist;
use Respect\Validation as v;

/*
 * Answers the question "is the value of this type?"
 * Exposes method sniffType(), which delegates to private methods
 */
class TypeInspector implements TypeInspectorInterface
{

    /**
     * Answers the question "what type is this string?
     * @return string
     */
    public function sniffType(string $value) : string
    {
        /*
         * set 1, check for IP addresses
         */
        if($this->is($value, 'Ip4'))
        {
            return 'Ip4';
        }

        /*
         * set 2, check for various number id's
         */

        /*
         * set 3, check for various names
         */

        /*
         * if no other match, assign AlphaNumeric
         */
        return 'AlphaNumeric';

    }

    /**
     * Answers the question "is this value of this type?"
     * Delegate validation to private methods
     * @param string $type
     * @return bool
     */
    private function is(string $value, string $type) : bool
    {
        /*
         * use PHP's "variable function" feature
         * map a string "function" to method isFunction()
         * is_callable() guards against bad input
         */
        //if (is_callable($type))
        $type = "is" . $type;
            return $this->$type($value);

        //else
        //throw new TypeCheckFunctionDoesNotExist();
    }

    private function isAlphaNumeric(string $value) : bool
    {
        //checking logic
        return FALSE;
    }

    private function isIp4(string $value) : bool
    {
        if( filter_var($value, FILTER_VALIDATE_IP,FILTER_FLAG_IPV4) )
        {
            return TRUE;
        }
        //else
        return FALSE;
    }

    private function isIp6(string $value) : bool
    {
        if( filter_var($value, FILTER_VALIDATE_IP,FILTER_FLAG_IPV6) )
        {
            return TRUE;
        }
        //else
        return FALSE;
    }
}