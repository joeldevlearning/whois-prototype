<?php

namespace RestQuery\Action\Setup;


class IsEmpty
{
    public static function string($value)
    {
        return empty($value) && !is_numeric($value);
    }
}