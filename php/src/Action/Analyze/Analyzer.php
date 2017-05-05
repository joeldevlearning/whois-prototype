<?php

namespace RestQuery\Action\Analyze;

/*
 * intended to be called with a fluent interface
 * e.g. Analyzer->loadRuleBook()->findTargets()
 *
 */
use RestQuery\QueryInterface;

class Analyzer
{
    private $query;
    private $rules;
    private $analyzerResults;

    public function matchRules() : self
    {
        if($this->query->hasPrimaryOnly()
        )
        {
            $this->analyzerResults = $this->rules->applyFor('primaryOnly');
        }

        /*
        - 1) what condition do we meet? (primaryOnly, etc.), ensure ONLY one catch here
	    - match condition to rulebook rules ()
	    - ruleset calls model to get records
	    - return array of records:fields to call
         *
         */

        return $this;
    }

    public function getAnalyzerResults() : array
    {
        return $this->analyzerResults;
    }

    public function __construct(QueryInterface $query)
    {
        $this->query = $query;
        $this->rules = new RuleBook($query);
    }
}