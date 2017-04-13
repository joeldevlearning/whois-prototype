<?php

namespace RestQuery\Action\Setup;

use RestQuery\Action\Setup\{
    Filter, IsEmpty, IsValid
};
use RestQuery\Exception\QueryInputWasInvalid;

class Setup
{
    //Step 1, filter input with Filter::httpGetSelectors
    //Step 2, filter parameters with Filter::httpGetParameters

    //Step 3, validate input
    public static function validateInput($qSelectors)
    {
        if (IsValid::content($qSelectors) === false ||
            IsValid::flag($qSelectors) === false ||
            IsValid::combination($qSelectors) === false
        ) {
            throw new QueryInputWasInvalid();
        }
    }

    //Step 4, determine selector types and create selector objects



}