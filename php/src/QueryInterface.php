<?php
namespace RestQuery;

/*
 * Defines contract for reading/writing to Query object
 */

use RestQuery\Query;
use RestQuery\Model\Type\TypeInterface;

interface QueryInterface
{
    public function getPrimary() : TypeInterface;

    public function getSecondary() : TypeInterface;

    public function getParameters() : array;

    public function setPrimary($primary) : Query;

    public function setSecondary($secondary) : Query;

    public function setParameters(array $qParameters) : Query;
}