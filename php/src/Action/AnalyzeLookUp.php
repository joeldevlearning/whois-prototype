<?php
namespace RestQuery\Action;
use RestQuery\Model\ArinModel as model;


class AnalyzeLookUp
{
    private $lookUpTable;

    /**
     * PHP does not allow the lambda expressions in default class variables/fields
     * So we put it in this function, called by the constructor
     */
    public function LoadLookUpTable()
    {
        //Define lambda
        $pull_AllRecordsHintName = function() {
            return model::PullRecordField( 'org', 'pr', 'all');
        };

        //push lambda to array
        $this->lookUpTable['ALL_RECORDS_HINT_NAME'] = $pull_AllRecordsHintName();

    }

    /**
     * @param string $key
     * @param array $lookUpTable
     * @return mixed
     * Used by Analyze class to access lookup table
     */
    public function LookUpRecordField( string $key) {
        return $this->lookUpTable[$key];
    }

    public function __construct()
    {
        $this->LoadLookUpTable(); //creates lambdas and matches them to constants in the lookup table
    }
}

/* How does Analyze class find the correct records and fields?
1) Analyze creates an instance of AnalyzeLookUp
2) Analyze selects a $CONSTANT (i.e. decides what set of records/fields it wants)
2) Analyze calls AnalyzeLookUp->LookUpRecordField($CONSTANT)
3) LookUpRecordField reads array $lookUpTable[$CONSTANT]
4) The key $lookUpTable[$CONSTANT] returns the value $LAMBDA
5) LookUpRecordField executes $LAMBDA, which contains the lookup logic
6) $LAMBDA calls ArinModel::PullRecordField
7) PullRecordField pulls actual record/fields from array, returns the set
8) LookUpRecordField returns the set to Analyze
9) Analyzer pushes $setCollection to $qBuildQueue
*/