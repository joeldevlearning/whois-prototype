<?php

namespace RestQuery\Model\Type;

/*
 * Defines contract for all Selector objects
 * Called directly TypeFactory::build(), indirectly by Create::Selector()
 */

interface TypeInterface
{
    /*
     *
     * implemented by trait CanReportType
     */
    public function getType() : string;

    public function getValue() : string;

    public function getFlag() : string;

    public function __construct(string $value, $flag);
}