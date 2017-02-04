<?php
namespace RestQuery;

use IQueryable;

/**
 * Encapsulates a single whois-RWS exchange (request and response)
 * Queryable are created by QueryTargetFactory
 * They are stored in Query->qTargetList[]
 * They are manipulated by the Analyze, Build, and Request classes
 * And they are read by the Transform class
 */

class Queryable implements IQueryable
{
    private $record;
    private $field;
    private $queryString; //full "/orgs;name=Apple*"
    private $httpCode;
    private $httpMessage;
    private $jsonBody;

    private $expression;
    private $type;
    private $format;

    /**
     * @return mixed
     */
    public function getExpression() : array
    {
        return $this->expression;
    }

    /**
     * @return mixed
     */
    public function getType() : string
    {
        return $this->type;
    }  //e.g. url matrix

    public function getRecord()
    {
        return $this->record;
    }
    public function getField()
    {
        return $this->field;
    }
    public function getFormat() : string
    {
        return $this->format;
    }

    public function getQuerySelectors()
    {
        return $array = [$this->record=>$this->field];
    }

    public function getQueryString()
    {
        return $this->queryString;
    }

    public function setQueryString($formattedString) //called by Build class
    {
        $this->queryString = $formattedString;
    }

    /**
     * @return mixed
     */
    public function getHttpCode()
    {
        return $this->httpCode;
    }

    /**
     * @param mixed $httpCode
     */
    public function setHttpCode($httpCode)
    {
        $this->httpCode = $httpCode;
    }

    /**
     * @return mixed
     */
    public function getHttpMessage()
    {
        return $this->httpMessage;
    }

    /**
     * @param mixed $httpMessage
     */
    public function setHttpMessage($httpMessage)
    {
        $this->httpMessage = $httpMessage;
    }

    /**
     * @return mixed
     */
    public function getJsonBody()
    {
        return $this->jsonBody;
    }

    /**
     * @param mixed $jsonBody
     */
    public function setJsonBody($jsonBody)
    {
        $this->jsonBody = $jsonBody;
    }


    public function getResult() : \Generator
    {
        yield;
    }

    /**
     * QueryTarget constructor.
     * @param $record
     * @param $field
     * @param $format
     */
    public function __construct($record, $field, $format)
    {
        $this->record = $record;
        $this->field = $field;
        $this->format = $format;
    }
}