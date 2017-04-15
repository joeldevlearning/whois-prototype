<?php
namespace RestQuery\Action\Setup;

use RestQuery\Model\Type\TypeInspector;

/*
 * Determines type of of selector input
 * Delegates to TypeInspector
 * Called by Setup::Create action
 */
class AssignType
{
    public function __invoke(string $value)
    {
        $thisType = new TypeInspector();

        if($thisType->is($value, 'AlphaNumeric'))
        {
            return 'AlphaNumeric';
        }

        /*
         * Should NOT reach this point
         * Assign AlphaNumeric if no other type sticks
         */
        return 'AlphaNumeric';
    }

}
