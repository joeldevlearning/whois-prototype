<?php
namespace RestQuery\Exception;


/*
 * TODO: this exception should call Respond actions
 *
 *
 */


class QueryInputWasInvalid extends \InvalidArgumentException
{
    public static function fromValidate( $code = null, \Exception $previous = null )
    {
        $message = "The query contained invalid input.";

        return new static( $message, $code, $previous );
    }

}