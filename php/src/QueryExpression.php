<?php
namespace RestQuery;

/*
 * Holds data and basic commands for query processing
 * Stored in Query object
 *
 */


class QueryExpression
{
    private $primary = [
        'type' => NULL,
        'value' => NULL,
        'record-scope' => NULL,
        'field-scope' => NULL,
    ];

    private $secondary = [
        'type' => NULL,
        'value' => NULL,
        'record-scope' => NULL,
        'field-scope' => NULL,
    ];

    private $commandChain = [];

    //TODO ideally getNextCommand() can also return the private arrays
    //if so, the consuming object needs no logic about what data to use, it just accepts and processes
    //we should integrate this sequential logic into the commandChain somehow

    public function getNextCommand() {} //TODO generator for command chain

    public function __construct()
    {
        //TODO populate private fields
    }
}
