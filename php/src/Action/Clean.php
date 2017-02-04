<?php
namespace RestQuery\Action;

/*
 * Sanitize input and validate query selectors
 * Delegates to other classes prefixed with the name "Clean"
 */

use RestQuery\Query;
use RestQuery\Action\CleanSanitize as CleanSanitize;
use RestQuery\Action\CleanValidate as CleanValidate;

class Clean
{
    /**
     * Check length, character encoding, etc. of user input
     * Delegates to CleanSanitize class
     * @param Query $query
     */
    public static function Sanitize(Query $query)
    {
        $sanitize = new CleanSanitize();
        $sanitize($query);
    }


    /**
     * Check for ambiguous combinations of query selectors
     * Delegates to CleanValidate class
     * @param Query $query
     */
    public static function Validate(Query $query)
    {
        $validate = new CleanValidate();
        $validate($query);
    }

}
