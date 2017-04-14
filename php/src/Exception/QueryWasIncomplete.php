<?php
namespace RestQuery\Exception;


/*
 * TODO: this exception should call Respond actions
 *
 *
 */


class QueryWasIncomplete extends \InvalidArgumentException
{
    public static function fromSetup( $view, $code = null, \Exception $previous = null )
    {
        $message = "something";

        return new static( $message, $code, $previous );
    }

}