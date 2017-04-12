<?php

namespace RestQuery\Model\Type;


interface AbstractTypeInterface
{
    public function getType() : string;

    public function getValue() : string;

    public function getFlag() : string;

    public function __construct(string $type, string $value);
}