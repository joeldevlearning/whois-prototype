<?php

namespace Query;

class Query {
        /* @var array Contains mutable state of GET variables
        * "primary" refers to the *desired* record type;"secondary" to a where-like condition on the primary
        * set by Query constructor, written to by Clean class
        */
        public $qElements = array();
        
        /* @var integer Defines constraints on query, based on user input
        * 1 = only primary search string, no specific record type 
        * 2 = only primary search string, ONE specific record type desired
        * 3 = only primary search string, ONE specific record type desired based on matching specific primary record type
        * 4 = primary and secondary search strings, specific record AND field desired
        * set by Analyze class
        */
        public $qType = "";
        
        /* @var array Contains bool flags for records
        * used to direct which record types to search and return
        * alphabetical order
        * set by Analyze class
        */
        public $qRecordList = [
            'asn' => FALSE,
            'cus' => FALSE,
            'del' => FALSE,
            'net' => FALSE,
            'poc' => FALSE,
            'org' => FALSE,            
        ];

        /* @var array Contains bools flags of fields within records
        * used to direct searches on specific fields
        * same order as whois.arin.net search results
        * set by Analyze class
        */
        public $qFieldList = array(
            'asn' => array(
                'number'        => FALSE, //a range, but you can search by a single value within the range, e.g. "12345" returns "12288 - 13311"
                'name'          => FALSE, //e.g. RIPE-ASNBLOCK8
                'handle'        => FALSE, //e.g. AS12288 or '12288', same as "number" but with "AS" prefix
                'organization'  => FALSE, //real name of owning entity
            ),
            'cus' => array(
                'name'          => FALSE, //real name
                'handle'        => FALSE, //e.g. C12345 or '123456'
                'city'          => FALSE, //MIGHT be abbreviated
                'state'         => FALSE, //abbreviation, two letters
                'country'       => FALSE, //abbreviation
                'net-handle'    => FALSE, //link to related net record
                'net-range'     => FALSE, //IP address range of linked net record
            ),
            'del' => array(
                'name'          => FALSE, //TODO, learn about this record type
            ),
            'net' => array(
                'net-range'     => FALSE, //IP address range of linked net record, individual IP's within range are accepted
                'cidr'          => FALSE, //CIDR value, e.g. 192.42.249.0/24
                'name'          => FALSE, //shortened name of owning entity
                'handle'        => FALSE, //e.g. NET-192-69-2-0-1
                'parent'        => FALSE, //parent network, e.g. NET-192 or NET-192-0-0-0-0
                'origin-as'     => FALSE,  //related asn handle
                'organization'  => FALSE, //real name of owning org, AND its org handle AND a link to org record
                'net-block'     => FALSE, //IP address range of linked net record
            ),
            'org' => array(
                'name'          => FALSE, //real name
                'handle'        => FALSE, //e.g. ARIN-123
                'city'          => FALSE, //MIGHT be abbreviated
                'state'         => FALSE, //abbreviated
                'country'       => FALSE, //abbreviated
            ),
            'poc' => array(
                'name'          => FALSE, //last, first, e.g. "Doe, Jane", unclear how it works but searching "Jane" only may not find "Doe"
                'handle'        => FALSE, //e.g. ARIN1-ARIN, where entity name is doubled
                'company'       => FALSE, //real name, but no guarantee to match handle              
                'city'          => FALSE, //MIGHT be abbreviated
                'state'         => FALSE, //abbreviated
                'country'       => FALSE, //abbreviated
                'phone'         => FALSE, //one or more phone numbers, e.g. 1-800-800-8000
                'email'         => FALSE, 
            ),
        );

        public $qBatch;

		/* @var DateTime */
        public $timestamp; 

        function __construct() {
            $this->qElements = [
            "pr"        => filter_input(INPUT_GET, 'pr', FILTER_SANITIZE_STRING),
            "prFlag"    => filter_input(INPUT_GET, 'pr_flag', FILTER_SANITIZE_STRING),
            "se"        => filter_input(INPUT_GET, 'sr', FILTER_SANITIZE_STRING),
            "seFlag"    => filter_input(INPUT_GET, 'sr_flag', FILTER_SANITIZE_STRING),
            ];
            if(empty($query->qElements['pr'])) {
            $query->qElements['pr'] = NULL;
            }
            if(empty($query->qElements['prFlag'])) {
                $query->qElements['prFlag'] = NULL;
            }
            if(empty($query->qElements['se'])) {
                $query->qElements['se'] = NULL;
            }
            if(empty($query->qElements['seFlag'])) {
                $query->qElements['seFlag'] = NULL;
            }
        }
	}