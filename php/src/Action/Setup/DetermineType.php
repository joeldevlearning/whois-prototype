<?php
namespace RestQuery\Action\Setup;

use RestQuery\Query;
use RestQuery\Action\Setup\IsType;

/*
 * Parses user input and stores it in an object derived from AbstractType
 * Called by the Analyze class
 */

class DetermineType
{
    public function __invoke(Query $query)
    {
        //go through type three testing which type we catch
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