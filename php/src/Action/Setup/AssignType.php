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
    /**
     * Answers the question "is this value of this type?"
     * @param string $value
     * @return string of type, to be passed to TypeFactory
     */
    public function __invoke(string $value)
    {
        //TypeInspector holds value, passes it internally to is()
        $thisValue = new TypeInspector($value);

        if($thisValue->is('AlphaNumeric'))
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
