<?php
namespace RestQuery;

/*
 * Contains validated selector data
 *
 */

class QuerySelector
{
    public $value;
    public $flag;
    public $typeToken;

    public function __construct(string $value, string $flag)
    {
        $this->value = $value;
        $this->flag = $flag;
    }
}