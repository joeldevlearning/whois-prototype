<?php
/*should contain... 
Filter()
Validate()
can alias as "clean", e.g. clean::Filter($query)

*/
namespace Query;

class Query {

public static function hello() {echo "Hello Query!";}

        /** @var array Contains validated query strings and parameters*/
        var $qElements;    

        /** @var array Contains bools indicating which types of records to query */
        var $qRecordList;

        /** @var array Contains bools indicating which types of fields to query*/
        var $qFieldList;

        var $qBatch;

		/** @var DateTime */
        var $timestamp; 

        function Fill(){} //fill record and field lists
        function Run(){}  //run query batches

        function __construct(array $cleanInput) {
            $this->$timestamp = new DateTime();
            $this->$qElements = $cleanInput;
        }
	}