<?php
namespace RestQuery\Action\Analyze;

use RestQuery\Query;
use RestQuery\Model\Type\TypeFactory as type;
use RestQuery\Action\Analyze\IdentifyType as id;

/*
 * Parses user input and stores it in an object derived from AbstractType
 * Called by the Analyze class
 */

class AssignType
{
    public function __invoke(Query $query)
    {
        $PrSelector = $query->getRawSelector('pr');
        if ($PrSelector) {
            $typedObject = type::build(
                id::Identify($PrSelector),
                $PrSelector
            );

            setTypedSelector('pr', $typedObject);
        }

        if ($SerSelector) {
            $typedObject = type::build(
                id::Identify($SeSelector),
                $SeSelector
            );

            setTypedSelector('se', $typedObject);
        }
    }
}
/*
 * step 1, review list of all types
 * step 2, break into two groups
 * step 3, within groups, organize types by specificity
 * step 4, create filters to mirror groups
 *
 *
 *
 */