<?php

namespace RestQuery;

/*
 * Singleton that holds the state of a query
 * Is mutated by various "Action" objects
 */

class Query implements QueryInterface
{
    //public $qSelectors = array(); REPLACED WITH OBJECTS

    private $primary;
    private $secondary;
    private $qParameters = array();

    public function getPrimary(): object
    {
        return $this->primary;
    }

    public function getSecondary(): object
    {
        return $this->secondary;
    }

    /**
     * Primary setter - fluent style, accept & return object
     */
    public function setPrimary($primary)
    {
        $this->primary = $primary;
        return $this;
    }

    /**
     * Secondary setter - fluent style, accept & return object
     */
    public function setSecondary($secondary)
    {
        $this->secondary = $secondary;
        return $this;
    }

    public function setParameters(array $qParameters)
    {
        $this->qParameters = $qParameters;
        return $this;
    }

    /**
     * Static constructor
     * Enables us to configure object with fluent interface
     * PHP only allows one constructor; this allows objects constructed with variable inputs
     * example: $q = Query::create()->setPrimary($var)->setSecondary($var);
     */

    public static function create()
    {
        return new self();
    }

    /* @var integer Indicates what type of hint is available
     * "0" = no hint, hinting disabled
     * "1" = hint available, hinting enabled
     */

    //public $qType = "";

    /* @var array Contains list of records to query
     * should be in the format of [0][recordType=>fieldType]
     */
    //public $qBuildQueue = array();

    /*
     * Right now we are pulling directly from qRunQueue
for abstraction we could use an iterator/generator
this would wrap qRunQueue
calls to the RunQueue would return one-by-one results from the array

     */
    //public $qRunQueue = array();

    //public $qTransformQueue = array();

    //public $qReportQueue = array();

    //public $qRespondQueue = array();

    public function __construct()
    {

    }
}