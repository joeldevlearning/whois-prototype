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

    public function setPrimary(object $primary): object;

    public function setSecondary(object $secondary): object;

    public function setParameters(array $qParameters): object;

}