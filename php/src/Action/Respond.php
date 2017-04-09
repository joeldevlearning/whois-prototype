<?php
namespace RestQuery\Action;

use RestQuery\Query;

class Respond
{
//TODO return the proper headers here with an error message

    public static function QueryNotSupported()
    {
        $message = "The combination of query parameters is unsupported.";
        header('Content-Type: application/json');
        echo $message;
        exit;
    }

    public static function InvalidInput()
    {
        $message = "The query contained invalid input.";
        header('Content-Type: application/json');
        echo $message;
        exit;
    }

    /**
     * @param $q
     */
    public static function SendResults($q)
    {
        $data = json_encode($q->qTransformQueue);

//$tempJson = json_encode("hello:1");
        header('Content-Type: application/json');
        echo $data;
    }

}

/*
 * good REST practice
code – contains the HTTP response status code as an integer.

status – contains the text: “success”, “fail”, or “error”. Where “fail” is for HTTP status
response values from 500-599, “error” is for statuses 400-499, and “success” is for everything
else (e.g. 1XX, 2XX and 3XX responses).

message – only used for “fail” and “error” statuses to contain the error message. For
internationalization (i18n) purposes, this could contain a message number or code, either alone
or contained within delimiters.

data – that contains the response body. In the case of “error” or “fail” statuses, this contains the
cause, or exception name.
 *
 * A successful response in wrapped style looks similar to this:
{"code":200,"status":"success","data":
{"lacksTOS":false,"invalidCredentials":false,"authToken":"4ee683baa2a3332c3c86026d"}}

An example error response in wrapped style looks like this:
{"code":401,"status":"error","message":"token is invalid","data":"UnauthorizedException"}
 *
 */