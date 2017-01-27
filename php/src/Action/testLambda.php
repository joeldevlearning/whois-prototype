<?php
namespace RestQuery\Action;
use RestQuery\Arin\ArinModel as model;

//eventually name this AnalyzeLookUp

$func = array(
    'a' => array(
        'b' => function() {
            echo "hello";
        }
    )
);
$call = $func['a']['b'];
$call();


/*1) Analyzer selects $CONSTANT
  2) Analyzer calls ArinModel::LookUpTarget($CONSTANT)
  3) LookUpTarget reads array $lookUpSet[$CONSTANT]
  4) The key $lookUpSet[$CONSTANT] returns the value $LAMBDA
  5) LookUpTarget executes $LAMBDA
  6) $LAMBDA returns predefined array $setCollection, which LookUpTarget returns
  7) Analyzer pushes $setCollection to $qBuildQueue

*/
function LookUpSet(string $key, array $lookUpSet) {
    return call_user_func($lookUpSet[$key]);
}

//define lambda
//should be under AnalyzeLookup class
//TODO make lambda pull from ArinModel->referenceModel
$pull_AllRecordsHintName = function($model) {
    //set the record type
    //TODO create a 2-level array, with 0+n keys on 1st level, and record=>field on second level
    //$model['org'] = $recordType
    //foreach $model['org-pr-all'] = $newArray[][$recordtype=>$field];

    $set = array(
        0 => array('org'=>'name'),
        1 => array('org'=>'handle'),
    );
    return $set;
};

//store lambda in array
//this array should be under ArinModel class
$lookUpTable = array(
    'AllRecordsHintName' => $pull_AllRecordsHintName,
);

//retrieve lambda
$testValue = LookUpSet('AllRecordsHintName', $lookUpTable);
print_r($testValue);


/*TODO structure model data in here for retrieval
maybe try org-pr-all, org-pr-name-all, org-pr-number-all, org-se-all, org-se-name-all, org-se-number-all
then AllRecordsHintName = org-pr-all
store this model in ArinModel class
*/
$fakeReferenceModel = array(
    'org' => array(//record type
        'org-pr-all' => array(//set of fields
            'name',
            'handle'
        ) 
    )
);