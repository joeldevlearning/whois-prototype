<?php

/*
 * Defines contract for reading/writing to Query object
 *
 */

namespace RestQuery;

interface QueryInterface
{
    /*
     * pulls $query->primary|secondary
     * called by various actions
    */
    public function GetPr() : object;
    public function GetSe() : object;

}