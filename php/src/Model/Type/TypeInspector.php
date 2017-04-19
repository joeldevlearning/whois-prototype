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
    private $matcher;
    /**
     * Answers the question "what type is this string?
     * @return string
     */
    public function sniffType(string $value) : string
    {
        /*
         * set 1, check for IP addresses
         */
        if($this->matches($value, 'Ip4'))
        {
            return 'Ip4';
        }

        if($this->matches($value, 'Ip6'))
        {
            return 'Ip6';
        }

        if($this->matches($value, 'Cidr4'))
        {
            return 'Cidr4';
        }

        if($this->matches($value, 'Cidr6'))
        {
            return 'Cidr6';
        }

        if($this->matches($value, 'Net4Handle'))
        {
            return 'Net4Handle';
        }

        if($this->matches($value, 'Net6Handle'))
        {
            return 'Net6Handle';
        }

        if($this->matches($value, 'AsNumber'))
        {
            return 'AsNumber';
        }

        if($this->matches($value, 'CustomerNumber'))
        {
            return 'CustomerNumber';
        }

        if($this->matches($value, 'EmailDomain'))
        {
            return 'EmailDomain';
        }

        if($this->matches($value, 'NumericDate'))
        {
            return 'NumericDate';
        }

        if($this->matches($value, 'Numeric'))
        {
            return 'Numeric';
        }

        // if no other match, assign AlphaNumeric
        return 'AlphaNumeric';
    }

    /**
     * Answers the question "is this value of this type?"
     * Delegate validation to private methods
     * @param string $type
     * @return bool
     */
    private function matches(string $value, string $type) : bool
    {
        /*
         * uses PHP's "variable function" feature
         * maps string "function" to method TypeMatchLogic::isFunction()
         * is_callable() guards against bad input
         */
        $type = "is" . $type;
        $testCallable = array($this->matcher, $type);
        if (is_callable($testCallable))
        {
            return $this->matcher->$type($value);
        }
        //else
        throw new TypeCheckFunctionDoesNotExist();
    }

    public function __construct()
    {
        $this->matcher = new TypeMatchLogic();
    }


    //
}