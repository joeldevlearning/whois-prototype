<?php

namespace RestQuery\Action\Analyze;

use RestQuery\Query;


class Analyzer
{
    private $ruleBook = null;

    public function findTargets(Query $query) : array
    {
        if(!$query->getPrimary()->getFlag() && !$query->getSecondary()->getFlag())
        {
            $this->ruleBook->loadRule($query, 'primaryOnly');
        }
        /*
        - what condition do we meet? (primaryOnly, etc.), ensure ONLY one catch here
	    - match condition to rulebook rules ()
	    - ruleset calls model to get records
	    - return array of records:fields to call
         *
         */
    }

    public function __construct(RuleBook $ruleBook)
    {
        $this->ruleBook = $ruleBook;
    }
}