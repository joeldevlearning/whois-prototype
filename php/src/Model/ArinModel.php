<?php
namespace RestQuery\Model;


class ArinModel
{
    private static $recordFieldList = array(
        'org' => array(//record type
            'org-pr-all' => array(//set of fields
                'name',
                'handle'
            ),
            'org-pr-name' => array(
                'name'
            )
        )
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
    public static function PullRecordField( $recordType, $selectorType, $hintScope )
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
        foreach( $rawSet as $fieldType ) {
            $formattedSet[ $inc ][ $recordType ] = $fieldType;
            $inc++;
        }
        return $formattedSet;
    }
}