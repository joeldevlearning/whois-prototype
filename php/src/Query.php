<?php
namespace RestQuery;

class Query {
        /* @var array Contains mutable state of GET variables
        * "primary" refers to the *desired* record type;"secondary" to a where-like condition on the primary
        * set by Query constructor, written to by Clean class
        */
        public $qSelectors = array();

        public $qParameters = array(
        'enable_hinting' => 1, //enable by default
        'enable_auto_wildcard' => 1, //enabled by default
        );
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
         * should be in the format of [0][recordType=>fieldType]
        */
        public $qBuildQueue = array();

        /*
         * Right now we are pulling directly from qRunQueue
for abstraction we could use an iterator/generator
this would wrap qRunQueue
calls to the RunQueue would return one-by-one results from the array

         */
        public $qRunQueue = array();

        public $qTransformQueue = array();

        public $qRespondQueue = array();

        public $qUriParts = array(
                'base-uri'              => 'http://whois.arin.net/rest/',
                'matrix-record-suffix'  => "s;",
                'matrix-field-prefix'   => "=",
                'wildcard'              => "*"
            );

        /* @var string Contains URI fragment that is constant for all queries
        * TODO separate this into a configuration file somewhere
        */

        public function __construct() {
            $this->qSelectors = [
            "pr"        => filter_input(INPUT_GET, 'pr', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            "prflag"    => filter_input(INPUT_GET, 'prflag', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            "se"        => filter_input(INPUT_GET, 'se', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            "seflag"    => filter_input(INPUT_GET, 'seflag', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            ];
            if(empty($this->qSelectors['pr'])) {
                $this->qSelectors['pr'] = NULL;
            }
            if(empty($this->qSelectors['prflag'])) {
                $this->qSelectors['prflag'] = NULL;
            }
            if(empty($this->qSelectors['se'])) {
                $this->qSelectors['se'] = NULL;
            }
            if(empty($this->qSelectors['seflag'])) {
                $this->qSelectors['seflag'] = NULL;
            }

            $hintFlag = filter_input(INPUT_GET, 'hint', FILTER_VALIDATE_INT);
            if($hintFlag == FALSE || $hintFlag == NULL) {
                //do nothing, default remains at 1
            }
            if($hintFlag == 0) {
                $this->qParameters['enable_hinting'] = 0;
            }
            else {/*do nothing, default remains at 1*/}

            $wildCardFlag = filter_input(INPUT_GET, 'wildcard', FILTER_VALIDATE_INT);
            if($wildCardFlag == FALSE || $wildCardFlag == NULL) {
                //do nothing, default remains at 1
            }
            if($wildCardFlag == 0) {
                $this->qParameters['enable_auto_wildcard'] = 0;
            }
            else {/*do nothing, default remains at 1*/}
        }
	}