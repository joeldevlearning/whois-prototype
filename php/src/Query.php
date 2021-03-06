<?php

namespace RestQuery;

/*
 * Singleton that holds the state of a query
 * Is mutated by various "Action" objects
 */
use RestQuery\Action\Request;
use RestQuery\Model\Type\TypeInterface;

class Query implements QueryInterface
{
    private $primary;
    private $secondary;
    private $qParameters = array();

    public function getPrimary() : TypeInterface
    {
        return $this->primary;
    }

    public function getSecondary() : TypeInterface
    {
        return $this->secondary;
    }

    public function getParameters() : array
    {
        return $this->qParameters;
    }

    /**
     * Primary setter - fluent style, accept & return object
     */
    public function setPrimary($primary) : Query
    {
        $this->primary = $primary;
        return $this;
    }

    /**
     * Secondary setter - fluent style, accept & return object
     */
    public function setSecondary($secondary) : Query
    {
        $this->secondary = $secondary;
        return $this;
    }

    public function setParameters(array $qParameters) : Query
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
    public static function create() : Query
    {
        return new self();
    }

    public function hasPrimaryOnly() : bool
    {
        return ($this->getPrimary()->getFlag() === NULL &&
                $this->getSecondary()->getType() === NULL
                ? true : false
        );
    }

    /* @var integer Indicates what type of hint is available
     * "0" = no hint, hinting disabled
     * "1" = hint available, hinting enabled
     */

    //public $qType = "";

    public $qBuildQueue = array();

    public $qRunQueue = array();

    public $qTransformQueue = array();

    public $qReportQueue = array();

    public $qRespondQueue = array();

    public function __construct()
    {

    }
}