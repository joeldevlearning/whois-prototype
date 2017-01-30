<?php
require __DIR__.'/vendor/autoload.php';
use RestQuery\Model\ArinModel as model;
use RestQuery\Action\AnalyzeLookUp as lookup;




//define lambda


//$testOutput = PullRecordField( 'org', 'pr', 'all', $fakeReferenceModel );
/*TEST*/
$lookup = new lookup();
$testValue = $lookup->LookUpRecordField('ALL_RECORDS_HINT_NAME');
var_dump($testValue);

