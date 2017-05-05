<?php

namespace RestQuery\Action\Analyze;

use RestQuery\QueryInterface;

class RuleBook
{
    private $query;

    public function applyFor($uniqueCondition)
    {
        switch ($uniqueCondition)
        {
            case 'primaryOnly':
            return $this->primaryOnly();
            break;

            default:
            return $this->primaryOnly();
            break;
        }
    }

    public function primaryOnly() : array
    {
           /*
            * put logic here
            * check if pr is of type IpAddress
            * if not, search in all Alnum records
            */
           return $array = [];
    }

       private function prAndPrFlag()
       {}

       private function prAndSe()
       {}

       private function prAndPrFlagAndSe()
       {}

       private function prAndSeAndSeFlag()
       {}

       private function allInput() //if all flags and selectors are set
       {}

       private function prFlagEqualsSeFlag() //special condition
       {}

       public function __construct(QueryInterface $query)
       {
           $this->query = $query;
       }
}