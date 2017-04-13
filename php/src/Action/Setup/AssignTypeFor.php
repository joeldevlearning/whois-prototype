<?php

namespace RestQuery\Action\Setup;

use RestQuery\Model\Type\TypeFactory as type;

class AssignTypeFor
{
    public static function Selector(string $selector, array $qSelectors) //return object
    {
        $typeObject = NULL;

        //create primary object
        if($selector === 'primary')
        {
            $type1 = 'AlphaNumeric'; //TODO temp variable
            if ($qSelectors[ 'prflag' ][ 'rawString' ] !== null)
            {
                $typeObject = type::buildWithFlag(
                    $type1,
                    $qSelectors[ 'pr' ][ 'rawString' ],
                    $qSelectors[ 'prflag' ][ 'rawString' ]
                );
            }
            else
            {
                $typeObject = type::build(
                    $type1,
                    $qSelectors[ 'pr' ][ 'rawString' ]
                );
            }
        }

        //create secondary object
        if($selector === 'secondary')
        {
            $type2 = 'AlphaNumeric'; //TODO temp variable
            if ($qSelectors[ 'seflag' ][ 'rawString' ] !== null)
            {
                $typeObject = type::buildWithFlag(
                    $type2,
                    $qSelectors[ 'se' ][ 'rawString' ],
                    $qSelectors[ 'seflag' ][ 'rawString' ]
                );
            }
            else
            {
                $typeObject = type::build(
                    $type2,
                    $qSelectors[ 'se' ][ 'rawString' ]
                );
            }
        }
        return $typeObject;
    }

}