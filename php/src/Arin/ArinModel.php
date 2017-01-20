<?php
namespace RestQuery\Arin;

//holds the list of records and fields 

class ArinModel {

    /* @var array Contains field names for each record type
        * used to direct searches on specific fields
        * same order as whois.arin.net search results
        * set by Analyze class
        */
        public static $SourceRecordFieldList = array(
            'asn' => array(
                    'asn-all' => array(
                        'number'        => FALSE, //a range, but you can search by a single value within the range, e.g. "12345" returns "12288 - 13311"
                        'name'          => FALSE, //e.g. RIPE-ASNBLOCK8
                        'handle'        => FALSE, //e.g. AS12288 or '12288', same as "number" but with "AS" prefix
                        'organization'  => FALSE, //real name of owning entity    
                    ),
                    'asn-name' => array(
                        'name'          => FALSE, //e.g. RIPE-ASNBLOCK8
                        'organization'  => FALSE, //real name of owning entity      
                    ),
                    'asn-number' => array(
                        'number'        => FALSE, //a range, but you can search by a single value within the range, e.g. "12345" returns "12288 - 13311"
                        'handle'        => FALSE, //e.g. AS12288 or '12288', same as "number" but with "AS" prefix
                    ),
            ),

            'cus' => array(
                    'cus-all' => array(
                        'name'          => FALSE, //real name
                        'handle'        => FALSE, //e.g. C12345 or '123456'
                        'city'          => FALSE, //MIGHT be abbreviated
                        'state'         => FALSE, //abbreviation, two letters
                        'country'       => FALSE, //abbreviation
                        'net-handle'    => FALSE, //link to related net record
                        'net-range'     => FALSE, //IP address range of linked net record
                    ),
                    'cus-name' => array(

                    ),
                    'cus-number' => array(

                    ),
            ),

            'rdn' => array(
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
                    'org-all' => array(),
                    'org-pr-hint-name' => array(
                        'name', //real name
                        'handle', //e.g. ARIN-123
                    ),
                    'org-pr-hint-number' => array(    
                    ),
                    'org-se-hint-name' => array(   
                        'name', //real name
                        'handle', //e.g. ARIN-123
                        'city',
                        'state',
                        'country'
                    ),
                    'org-se-hint-number' => array(    
                        'postal-code'
                    ),

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
}
