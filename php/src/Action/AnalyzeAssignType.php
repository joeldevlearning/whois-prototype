<?php
namespace RestQuery\Action;

use RestQuery\Query;
use RestQuery\Model\Type\TypeFactory;
use RestQuery\Model\ArinModel as model;


/*
 * Parses user input and stores it in an object derived from AbstractType
 * Called by the Analyze class
 */

class AnalyzeAssignType
{

    public function __invoke(Query $query)
    {
        /*
         * Need to filter input through various checks until we find the most specific type
         * call various helper methods here
         *
         */
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