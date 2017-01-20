<?php

namespace RestQuery;

class Query {
        /* @var array Contains mutable state of GET variables
        * "primary" refers to the *desired* record type;"secondary" to a where-like condition on the primary
        * set by Query constructor, written to by Clean class
        */
        public $qElements = array();
        
        /* @var integer Indicates what type of hint is available
        * "0" = no hint, hinting disabled
        * "1" = hint available, hinting enabled
        */
        public $hintFlag = "";
        /* @var integer Defines constraints on query, based on user input
        * 1 = only primary search string, no specific record type 
        * 2 = only primary search string, ONE specific record type desired
        * 3 = only primary search string, ONE specific record type desired based on matching specific primary record type
        * 4 = primary and secondary search strings, specific record AND field desired
        * set and read by Analyze class
        */
        public $qType = "";
        
        /* @var array Contains list of records to query
        */
        public $qTargetList = array(
        );

        public $qTargetUri = array(
            0 => array(
                'uri-fragments' => array(
                    'pr-string' => NULL,
                    'pr-record' => NULL,
                    'se-string' => NULL,
                    'se-record' => NULL
                    ),    
                'uri-full' => NULL //complete and conformant call the ARIN's API, ready to go       
            ),
        );

        /* @var string Contains URI fragment that is constant for all queries
        * TODO separate this into a configuration file somewhere
        */
        public $qBaseUri = 'http://whois.arin.net/rest/';

        function __construct() {
            $this->qElements = [
            "pr"        => filter_input(INPUT_GET, 'pr', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            "prflag"    => filter_input(INPUT_GET, 'prFlag', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            "se"        => filter_input(INPUT_GET, 'se', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            "seflag"    => filter_input(INPUT_GET, 'seFlag', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ];
            if(empty($query->qElements['pr'])) {
            $query->qElements['pr'] = NULL;
            }
            if(empty($query->qElements['prflag'])) {
                $query->qElements['prflag'] = NULL;
            }
            if(empty($query->qElements['se'])) {
                $query->qElements['se'] = NULL;
            }
            if(empty($query->qElements['seflag'])) {
                $query->qElements['seflag'] = NULL;
            }

            $this->hintFlag = filter_input(INPUT_GET, 'hint', FILTER_VALIDATE_INT);
            if(!$this->hintFlag){
              $hintFlag = 0;  
            }
        }
	}