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
    public function SetTypeToken($selector, $typeToken) : void;

    /*
     * pulls $query->qSelectors['pr|se']['typedObject']
     * typedObject is derived from AbstractType
     * typedObject's methods include getType(), getValue(), and getFlag()
    */
    public function GetPr() : object;
    public function GetSe() : object;

}