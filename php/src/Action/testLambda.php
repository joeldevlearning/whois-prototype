<?php
namespace RestQuery\Action;
use RestQuery\Model\ArinModel as model;

/*1) Analyzer selects $CONSTANT
  2) Analyzer calls ArinModel::LookUpRecordField($CONSTANT)
  3) LookUpRecordField reads array $lookUpTable[$CONSTANT]
  4) The key $lookUpTable[$CONSTANT] returns the value $LAMBDA
  5) LookUpRecordField executes $LAMBDA
  6) $LAMBDA calls PullRecordField,
  7) PullRecordField returns predefined array $setCollection, which LookUpRecordField returns
  7) Analyzer pushes $setCollection to $qBuildQueue
*/
/*
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

function LookUpRecordField(string $key, array $lookUpTable) {
    return $lookUpTable[$key];
}

$model = model::$fakeModel;
print_r(model::$fakeModel);
$pull_AllRecordsHintName = function() use ($model) {
    return PullRecordField( 'org', 'pr', 'all', $model);
};

$lookUpTable = array(
    'ALL_RECORDS_HINT_NAME' => $pull_AllRecordsHintName(),
);


function PullRecordField($recordType, $selectorType, $hintScope, $model) {
    //assume single array is source of data
    $targetSet = $recordType . '-' . $selectorType .'-' . $hintScope; //e.g. org-pr-all

    //call key to retrieve desired set
	$rawSet = $model[$recordType][$targetSet];

    /* returned array should be of the format
     * $array = [
     * $recordType => $fieldType,
     * $recordType => $fieldType ];
     */
    $formattedSet = array();
    $inc = 0;
    foreach ( $rawSet as $fieldType ) {
        $formattedSet[$inc][$recordType] = $fieldType;
        $inc++;
    }
    return $formattedSet;
}

//$testOutput = PullRecordField( 'org', 'pr', 'all', $fakeReferenceModel );
/*TEST*/
$testValue = LookUpRecordField('ALL_RECORDS_HINT_NAME', $lookUpTable);
var_dump($testValue);

