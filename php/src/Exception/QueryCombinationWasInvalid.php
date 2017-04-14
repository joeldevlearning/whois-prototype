<?php
namespace RestQuery\Exception;

class QueryCombinationWasInvalid extends \InvalidArgumentException
{
    public static function fromSetup( $code = null, \Exception $previous = null )
    {
        $message = "The combination of inputs is invalid.";

        return new static( $message, $code, $previous );
    }

}