<?php
namespace RestQuery\Action;

use Respect\Validation\Validator as validate;
use RestQuery\Query;
class Clean
{
    /**
    * Populates Query object with filtered, validated input
    *
    * @param mixed[] $_GET The superglobal is implicitly passed
    * @param object $query Passed a new instance of Query
    *
    * @return object $query Returned with $qElements populated
    */

    public static function Validate(Query $query)
    {
        $prTemp = $query->qElements['pr'];
        $prFlagTemp = $query->qElements['prflag'];
        $srTemp = $query->qElements['se'];
        $srFlagTemp = $query->qElements['seflag'];

        $searchStringValidator = validate::stringType()->length(1, 255);
        $recordFlagStringValidator = validate::stringType()->length(1, 12);

        $isPrimarySearchValid = $searchStringValidator->validate($prTemp);
        $isPrimaryFlagValid = $recordFlagStringValidator->validate($prFlagTemp);
        $isSecondarySearchValid = $searchStringValidator->validate($srTemp);
        $isSecondaryFlagValid = $recordFlagStringValidator->validate($srFlagTemp);
    
        if ($isPrimarySearchValid == FALSE) {
            $query->qElements['pr']  = NULL; //magic null value
        }

        if ($isPrimaryFlagValid == FALSE) {
            $query->qElements['prflag']  = NULL; //magic null value
        }

        if ($isSecondarySearchValid == FALSE) {
            $query->qElements['se']  = NULL; //magic null value
        }

        if ($isSecondaryFlagValid == FALSE) {
            $query->qElements['seflag']  = NULL; //magic null value
        }
    }
}
