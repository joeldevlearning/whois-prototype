<?php
namespace RestQuery\Exception;


/*
 * TODO: this exception should call Respond actions
 *
 *
 */


class QueryWasIncomplete extends \InvalidArgumentException
{
    public static function fromView( $view, $code = null, \Exception $previous = null )
    {
        $message = "something";

        return new static( $message, $code, $previous );
    }

}