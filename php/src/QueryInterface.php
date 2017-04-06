<?php

/*
 * Defines contract for reading/writing to Query object
 *
 */

namespace RestQuery;

interface QueryInterface
{
    /*
     * pulls $query->qSelectors['pr|prflag|se|seflag']['rawString']
     * called by Sanitize action
     */
    public function getRawSelector($selector) : string;

    /*
     * sets $query->qSelectors['pr']['typedObject']
     * called by Analyze action
     */
    public function setTypedSelector($selector, $typedObject);

    /*
     * pulls $query->qSelectors['pr|se']['typedObject']
     * typedObject is derived from AbstractType
     * typedObject's methods include getType(), getValue(), and getFlag()
    */
    public function getPr() : object;
    public function getSe() : object;

}