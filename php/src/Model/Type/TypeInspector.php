<?php

namespace RestQuery\Model\Type;

/*
 * Answers the question "is the value of this type?"
 * Exposes is()
 * Uses a predefined list of lambdas
 */
class TypeInspector implements TypeInspectorInterface
{
    private $value;
    private $TypeCheckList;

    public function is(string $type) : bool
    {
        //NOTE: lamda variables are indexed in lowercase
        //WARNING: strtolower() is NOT unicode/mb_string friendly
        $type = strtolower($type);

        //
        $typeChecker = $this->TypeCheckList[$type];
        return $typeChecker($this->value);
    }

    /**
     * Lookup array for type-checking lamdas
     * Array keys are lowercase; lambda variables are camelCase
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
    public function __construct(string $value)
    {
        $this->value = $value;
        $this->loadCheckList();
    }
}