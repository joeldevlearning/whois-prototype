<?php

namespace RestQuery\Model\Type;

/*
 * Calls lambda to answer the question "is the value of this type?"
 * Uses a predefined list of lambdas
 */
class TypeInspector implements TypeInspectorInterface
{
    private $TypeCheckList;

    public function is(string $value, string $type) : bool
    {
        //convert string to lower case for simpler calling
        //strtolower() is NOT unicode/mb_string friendly
        $type = strtolower($type);
        return $this->TypeCheckList[$type];
    }

    /*
     * Define each lambda for checking a type and load it in the lookup list
     */
    private function loadCheckList() : void
    {
        $TypeCheckerList['alphanumeric'] = $isAlphaNumeric = function($value) : bool
            {
                //checking logic
                return FALSE;
            };

        $TypeCheckerList['customernumber'] = $isCustomerNumber = function($value) : bool
            {
                //checking logic
                return FALSE;
            };
    }

    /*
     * Instantiate to load list of type check lambdas
     */
    public function __construct()
    {
        $this->loadCheckList();
    }
}