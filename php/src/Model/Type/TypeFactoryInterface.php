<?php
namespace RestQuery\Model\Type;

/*
 * Defines contract for calling TypeFactory
 *
 */

interface TypeFactoryInterface
{
    public static function build($type, $value);
    /*
     * Ideally we want the return declaration to be something like "subclass of AbstractType"
     * But PHP 7.x currently only supports "instance of" like relationships
     */
}