<?php
namespace RestQuery\Model\Type;

/*
 * Implements TypeFactory contract
 * Delegates type object implementation to AbstractType
 *
 */

class TypeFactory implements TypeFactoryInterface
{
    public static function build($type, $value)
    {
            $typeObject = NULL;
            switch ($type)
            {
                case "IpAddress":
                    $typeObject = new IpAddress($value);
                    break;
                case "CustomerNumber":
                    $typeObject = new CustomerNumber($value);
                    break;
                default://TODO this path is invalid for se values
                    $typeObject = new GenericPrimaryName($value);
                    break;
            }//end switch
        return $typeObject;
    }
}

