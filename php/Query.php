<?php


class Query {
        /** @var array Contains validated query strings and parameters*/
        var $qElements;    

        /** @var array Contains bools indicating which types of records to query */
        var $qRecordList;

        /** @var array Contains bools indicating which types of fields to query*/
        var $qFieldList;

		/** @var DateTime */
        var $timestamp; 

        //require raw queries
        function __construct(array $cleanInput) {
            $this->$timestamp = new DateTime();
        }
	}

    