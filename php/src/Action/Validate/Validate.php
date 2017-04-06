<?php
namespace RestQuery\Action\Validate;

/*
 * Validates combination of selectors from user input
 * To give earlier user feedback, also implement these checks on the client
 *
 */
use RestQuery\Query;
use RestQuery\Action\Validate\IsValidCombination as checkCombo;
use RestQuery\Action\Validate\IsValidString as checkInput;
use RestQuery\Action\Respond as respond;

class Validate
{
    public static function ValidateSelectors(array $qSelectors)
    {
        $isValidCombo = checkCombo::IsValidSelectorCombo($qSelectors);
        $isValidString = checkInput::IsValidStringInput($qSelectors);

        if( !$isValidCombo )
        {
            respond::QueryNotSupported();
            exit;
        }

        if( !$isValidString )
        {
            respond::InvalidInput();
            exit;
        }

        return $query;
    }

}