<?php
namespace RestQuery\Model\Type;

/*
 * Defines contract for calling TypeFactory
 */

interface TypeFactoryInterface
{
    public static function build(string $type, string $value, $flag) : TypeInterface;
}