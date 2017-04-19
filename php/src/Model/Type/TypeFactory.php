<?php

namespace RestQuery\Model\Type;

/*
 * Implements TypeFactory contract
 *
 */

use RestQuery\Exception\TypeDoesNotExist;

class TypeFactory implements TypeFactoryInterface
{
    /*
     * PHP allows a string variable after the "new" keyword
     * effectively, we interpolate the class name into the object instantiation
     * we use this instead a switch statement where each object type has its own case
     */

    /**
     * @param $type
     * @param $value
     * @return object, instance of AbstractType
     */
    public static function build(string $type, string $value, $flag) : AbstractTypeInterface
    {
        $typeNamespace = "RestQuery\\Model\\Type\\"; //can we avoid hardcoding this value?
        $fullTypeName = $typeNamespace . $type;

        //return new object derived implicitly from AbstractType
        return new $fullTypeName($type, $value, $flag);
    }

    /**
     * Used when a selector is NULL
     * @return AbstractTypeInterface
     */
    public static function buildNullAndEmpty() : AbstractTypeInterface
    {
        $type = '';
        $value = '';
        $flag = '';
        return new NullAndEmpty($type, $value, $flag);
    }
}

