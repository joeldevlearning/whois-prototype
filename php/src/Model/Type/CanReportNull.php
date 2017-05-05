<?php

namespace RestQuery\Model\Type;

trait CanReportNull
{
    /*
     * For the NullAndEmpty Type; always reports itself with NULL
     */
    public function getType() : NULL
    {
        return NULL;
    }
}