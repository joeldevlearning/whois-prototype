<?php
namespace RestQuery;

/*
 * Defines contract for reading/writing to Query object
 *
 */

interface QueryInterface
{

    public function getPrimary(): object;

    public function getSecondary(): object;

    public function setPrimary($primary); //return object

    public function setSecondary($secondary); //return object

    public function setParameters(array $qParameters); //return object

}