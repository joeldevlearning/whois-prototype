<?php
namespace Utility;
use Respect\Validation\Validator as validate;

class Clean
{

    public static function hello()
    {
        echo "Hello Clean!";
    }


    /**
    * Basic filter of $_GET variables using built-in filter_input()
    *
    * @param mixed[] $_GET The superglobal is implicitly passed
    *
    * @return mixed[] $filteredInput Returns array of four query elements
    */

    public static function Filter()
    {
        $rawPrimarySearch = filter_input(INPUT_GET, 'pr', FILTER_SANITIZE_STRING);
        $rawPrimaryFlag = filter_input(INPUT_GET, 'pr_flag', FILTER_SANITIZE_STRING);
        $rawSecondarySearch = filter_input(INPUT_GET, 'sr', FILTER_SANITIZE_STRING);
        $rawSecondaryFlag = filter_input(INPUT_GET, 'sr_flag', FILTER_SANITIZE_STRING);
            
        $filteredInput['primary_search']     = $rawPrimarySearch;
        $filteredInput['primary_flag']       = $rawPrimaryFlag;
        $filteredInput['secondary_search']   = $rawSecondarySearch;
        $filteredInput['secondary_flag']     = $rawSecondaryFlag;
        return $filteredInput;
    }

    /**
    * Validate input using third-party validator library
    *
    * @param mixed[] $filteredInput Accepts array of four query elements
    *
    * @return mixed[] $validatedInput Returns array of four query elements
    */
    public static function Validate(array $filteredInput)
    {
        $validatedInput = array();
            

        //using individual variables allows for simple syntax for validating
        $prTemp = $filteredInput['primary_search'];
        $prFlagTemp = $filteredInput['primary_flag'];
        $srTemp = $filteredInput['secondary_search'];
        $srFlagTemp = $filteredInput['secondary_flag'];

        $searchStringValidator = validate::stringType()->length(1, 255);
        $recordFlagStringValidator = validate::stringType()->length(1, 12);

        $isPrimarySearchValid = $searchStringValidator->validate($prTemp);
        $isPrimaryFlagValid = $recordFlagStringValidator->validate($prFlagTemp);
        $isSecondarySearchValid = $searchStringValidator->validate($srTemp);
        $isSecondaryFlagValid = $recordFlagStringValidator->validate($srFlagTemp);

        /*consider not using this, as it removes the unique variable names
        foreach ($rawInput as $string){
            if($string === NULL || $string === FALSE) {
            $string = "empty"; //magic default value 
            }
            else {
            $filteredInput[] = $string; 
            }
        }
*/
        if ($isPrimarySearchValid == false) {
            $validatedInput['primary_search']  = "dog"; //magic null value
        } else {
            $validatedInput['primary_search']  = $filteredInput['primary_search'];
        }

        if ($isPrimaryFlagValid == false) {
            $validatedInput['primary_flag']  = "empty"; //magic null value
        } else {
            $validatedInput['primary_flag']  = $filteredInput['primary_flag'];
        }

        if ($isSecondarySearchValid == false) {
            $validatedInput['secondary_search']  = "empty"; //magic null value
        } else {
            $validatedInput['seconary_search']  = $filteredInput['secondary_search'];
        }

        if ($isSecondaryFlagValid == false) {
            $validatedInput['secondary_flag']  = "empty"; //magic null value
        } else {
            $validatedInput['secondary_flag']  = $filteredInput['secondary_flag'];
        }

        return $validatedInput;
    }
}
