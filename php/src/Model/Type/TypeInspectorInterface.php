<?php

namespace RestQuery\Model\Type;

interface TypeInspectorInterface
{
    /**
     * Answers the question "is myString of this type?"
     * @param string $value
     * @param string $type
     * @return bool
     */
    public function is(string $value, string $type) : bool;
}