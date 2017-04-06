<?php

/*
 * Defines contract for reading/writing to Query object
 *
 */

namespace RestQuery;

interface QueryInterface
{
    /*
     * sets $query->qSelectors['pr']['typeToken']
     * called by Analyze action
     */
    public function SetTypeToken(string $selector, object $typeToken) : void;

    /*
     * pulls $query->primary|secondary
     * called by various actions
    */
    public function GetPr() : QuerySelector;
    public function GetSe() : QuerySelector;

}