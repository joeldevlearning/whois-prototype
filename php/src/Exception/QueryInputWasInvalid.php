<?php
namespace RestQuery\Exception;

class QueryInputWasInvalid extends \InvalidArgumentException
{
    public static function fromSetup( $code = null, \Exception $previous = null )
    {
        $message = "The query contained invalid input.";

        return new static( $message, $code, $previous );
    }

}