<?php
namespace RestQuery\Exception;

class TypeCheckFunctionDoesNotExist extends \InvalidArgumentException
{
    public static function fromQuery( $code = null, \Exception $previous = null )
    {
        $message = "TypeInspector tried to inspect input with a function name that does not exist.";

        return new static( $message, $code, $previous );
    }

}