<?php

namespace Query;

class Query {
        /** @var array Contains validated query strings and parameters
        * primary refers to the *desired* record type
        * secondary refers to a where-like condition on the primary
        * e.g. Find any (primary:)"org" "Apple" with (secondary:) "poc" "Jane Doe"
        */
        var $qElements = [
            "primary_record" => "",
            "primary_field" => "",
            "secondary_record" => "",
            "secondary_field" => "",            
        ];
        
        /** @var array Contains bool flags for records
        * used to direct which record types to search and return
        * alphabetical order
        */
        var $qRecordList = [
            'asn' => FALSE,
            'cus' => FALSE,
            'del' => FALSE,
            'net' => FALSE,
            'poc' => FALSE,
            'org' => FALSE,            
        ];

        /** @var array Contains bools flags of fields within records
        * used to direct searches on specific fields
        * same order as whois.arin.net search results
        */
        var $qFieldList = array(
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