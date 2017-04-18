<?php

namespace RestQuery\Model\Type;

interface TypeInspectorInterface
{
    /**
     * @return string
     */
    public function sniffType(string $value) : string;
}