<?php
namespace RestQuery;

/**
 * Encapsulates a single whois-RWS exchange (request and result)
 * Queryable are created by QueryTargetFactory
 * They are stored in Query->qTargetList[]
 * They are manipulated by the Analyze, Build, and Request classes
 * And they are read by the Transform class
 */

use IQueryable;



class Queryable implements IQueryable
{
    private $record; //our label for the record type
    private $field; //our label for field type

    private $recordLabel; //e.g. 'cust' is sometimes 'customers'
    private $fieldLabel; //TODO not sure if we need this

    private $expression; //ready to be processed string fragments, e.g. "orgs" and "Apple*"
    private $queryString; //full "/orgs;name=Apple*"

    //these should fall under a QueryableResult object
    //we can embed this object into eac Queryable
    private $resultHttpCode; 
    private $resultHttpMessage;
    private $resultJsonBody;

    /**
     * @return mixed
     */
    public function getRecordLabel()
    {
        return $this->recordLabel;
    }

    /**
     * @param mixed $recordLabel
     */
    public function setRecordLabel($recordLabel)
    {
        $this->recordLabel = $recordLabel;
    }

    /**
     * @return mixed
     */
    public function getFieldLabel()
    {
        return $this->fieldLabel;
    }

    /**
     * @param mixed $fieldLabel
     */
    public function setFieldLabel($fieldLabel)
    {
        $this->fieldLabel = $fieldLabel;
    }


    private $type;
    private $format;

    /**
     * @return mixed
     */
    public function getExpression() : array
    {
        return [$this->record => $this->field];
    }

    /**
     * @return mixed
     */
    public function getType() : string
    {
        return $this->type;
    }  //e.g. url matrix

    public function getRecord() : string
    {
        return $this->record;
    }
    public function getField() : string
    {
        return $this->field;
    }
    public function getFormat() : string
    {
        return $this->format;
    }

    public function getQuerySelectors() : array
    {
        return $array = [$this->record=>$this->field];
    }

    public function getQueryString()  : string
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
    public function getResultHttpCode()
    {
        return $this->resultHttpCode;
    }


    /**
     * @param $resultHttpCode
     */
    public function setResultHttpCode($resultHttpCode)
    {
        $this->httpCode = $resultHttpCode;
    }

    /**
     * @return mixed
     */
    public function getResultHttpMessage()
    {
        return $this->resultHttpMessage;
    }

    /**
     * @param mixed $resultHttpMessage
     */
    public function setHttpMessage($resultHttpMessage)
    {
        $this->resultHttpMessage = $resultHttpMessage;
    }

    /**
     * @return mixed
     */
    public function getResultJsonBody()
    {
        return $this->resultJsonBody;
    }

    /**
     * @param mixed $resultJsonBody
     */
    public function setJsonBody($resultJsonBody)
    {
        $this->resultJsonBody = $resultJsonBody;
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