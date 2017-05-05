<?php

namespace RestQuery\Action\Analyze;

use RestQuery\Query;

class RuleBook
{
       public function loadRule(Query $query, string $uniqueCondition)
       {

           switch ($uniqueCondition)
           {
               case 'primaryOnly':
                   self::prOnly($query);
                   break;

               default:
                   self::prOnly($query);
                   break;
           }

       }

       private function prOnly(Query $query)
       {

           /*
 * if type is NOT IpAddress, then search Alnum fields
 * return qTargets array
 */

       }

       private function prAndPrFlag()
       {}

       private function prAndSe()
       {}

       private function prAndPrFlagAndSe()
       {}

       private function prAndSeAndSeFlag()
       {}

       private function allInputDefined()
       {}

       private function prFlagEqualsSeFlag() //special condition
       {}

}