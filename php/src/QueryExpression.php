<?php
namespace RestQuery;

/*
 * Implicit Singleton that holds data and basic commands for query processing
 * Stored in Query object
 *
 */


class QueryExpression implements QueryExpressionInterface
{
    private $queryPath  = [];
    private $targetList = [];

    public function nextStep() : string
    {

    }

    public function getTarget(): array
    {
        return array(
            'org'       => 'name',
            'poc'       => 'name',
            'customer'  => 'name',
            'net'       => 'name',
            'asn'       => 'name'
        );
    }

    public function __construct(array $path, $step)
    {
        $this->queryPath = $path;
    }
}
