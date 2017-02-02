<?php
namespace RestQuery\Model;


class ArinModel
{
    private static $recordFieldList = array(
        'asn' => array(//record type
            'asn-pr-all' => array(//set of fields
                'name',
                'organization',
                'number',
                'handle'
            ),
            'asn-pr-name' => array(
                'name',
                'organization'
            ),
            'asn-pr-number' => array(
                'number',
                'handle'
            ),
        ),

        'cus' => array(//record type
            'cus-pr-all' => array(//set of fields
                'name',
                'handle'
            ),
            'cus-pr-name' => array(
                'name'
            ),
            'cus-pr-number' => array(
                'handle'
            ),
        ),

        'net' => array(//record type
            'net-pr-all' => array(//set of fields
                'name',
                'ip',
                'handle'
            ),
            'net-pr-name' => array(
                'name'
            ),
            'net-pr-number' => array(
                'ip',
                'handle'
            ),
        ),

        'org' => array(//record type
            'org-pr-all' => array(//set of fields
                'name',
                'handle'
            ),
            'org-pr-name' => array(
                'name',
                'handle'
            ),
            'org-pr-number' => null,// no viable number fields that identify record
        ),

        'poc' => array(//record type
            'poc-pr-all' => array(//set of fields
                'name',
                'handle',
                'domain'
            ),
            'poc-pr-name' => array(
                'name',
                'handle',
                'domain'
            ),
            'poc-pr-number' => null,
        ),
    );

    /**
     * @return array
     * Used to access model
     */
    private static function LoadModel()
    {
        return self::$recordFieldList;
    }

    /**
     * @param $recordType
     * @param $selectorType
     * @param $hintScope
     * @return array
     * Used by AnalyzeLookUp class to identify specific records & fields for queries
     */
    public static function PullRecordField($recordType, $selectorType, $hintScope)
    {
        //assume single array is source of data
        $model = self::LoadModel();
        $targetSet = $recordType . '-' . $selectorType . '-' . $hintScope; //e.g. org-pr-all

        //call key to retrieve desired set
        $rawSet = $model[ $recordType ][ $targetSet ];

        /* returned array should be of the format
         * $array = [ $recordType => $fieldType, $recordType => $fieldType ];
         */
        $formattedSet = array();
        $inc = 0;
        foreach ($rawSet as $fieldType) {
            $formattedSet[ $inc ][ $recordType ] = $fieldType;
            $inc++;
        }
        return $formattedSet;
    }
}