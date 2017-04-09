<?php

namespace RestQuery\Action\Setup;


class IsEmpty
{
    public static function String($value)
    {
        return empty($value) && !is_numeric($value);
    }
}