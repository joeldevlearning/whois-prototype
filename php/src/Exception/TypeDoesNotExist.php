<?php
namespace RestQuery\Exception;


/*
 * TODO: this exception should call Respond actions
 *
 *
 */


class TypeDoesNotExist extends \InvalidArgumentException
{
    public static function fromQuery( $code = null, \Exception $previous = null )
    {
        $message = "Could not create query; input type does not exist.";

        return new static( $message, $code, $previous );
    }

}