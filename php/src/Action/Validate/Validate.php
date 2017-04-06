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

class Validate
{

    public function __invoke(Query $query)
    {
        checkCombo::IsValidSelectorCombo($query);
        checkInput::IsValidStringInput($query);

        return $query;
    }

}