<?php
namespace RestQuery\Model\Type;

/*
 * Implements TypeFactory contract
 *
 */

class TypeFactory implements TypeFactoryInterface
{
    /*
     * PHP allows a string variable after the "new" keyword
     * effectively, we interpolate the class name into the object instantiation
     * we use this instead a switch statement where each object type has its own case
     */
    public static function build($type, $value)
    {
        $typeObject = NULL;
        $typeNamespace = "RestQuery\\Model\\Type\\"; //TODO can we avoid hardcoding this value?
        $fullTypeName = $typeNamespace . $type;
        $typeObject = new $fullTypeName($value);

        return $typeObject;
    }
}

