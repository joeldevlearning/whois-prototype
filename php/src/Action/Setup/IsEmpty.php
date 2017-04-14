<?php

namespace RestQuery\Action\Setup;

class IsEmpty
{
    /*
     * Work around type ambiguity in PHP's empty()
     * empty() function treats the string "0" as empty
     */
    public static function string($value)
    {
        return empty($value) && !is_numeric($value);
    }
}