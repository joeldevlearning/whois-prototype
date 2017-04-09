<?php
namespace RestQuery\Action\Validate;

/*
 * Validates selectors
 * delegates to other classes in Validate namespace
 */

use RestQuery\Action\Validate\IsValidCombination as checkCombo;
use RestQuery\Action\Validate\IsValidString as checkString;
use RestQuery\Action\Respond as respond;

class Validate
{
    public static function ValidateSelectors(array $qSelectors)
    {
        $isValidCombo = checkCombo::IsValidSelectorCombo($qSelectors);
        $isValidSearchString = checkString::IsValidSearchString($qSelectors);
        $isValidFlag = checkString::IsValidFlag($qSelectors);

        if( !$isValidCombo )
        {
            respond::QueryNotSupported();
            exit;
        }

        if( !$isValidSearchString ||
            !$isValidFlag)
        {
            respond::InvalidInput();
            exit;
        }
    }

}