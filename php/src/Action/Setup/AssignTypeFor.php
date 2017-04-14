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
            if ($qSelectors[ 'prflag' ] !== NULL)
            {
                $typeObject = type::build(
                    $type1,
                    $qSelectors[ 'pr' ],
                    $qSelectors[ 'prflag' ]
                );
            }
            else
            {
                $typeObject = type::build(
                    $type1,
                    $qSelectors[ 'pr' ],
                    null
                );
            }
        }

        //create secondary object
        if($selector === 'secondary')
        {
            $type2 = 'AlphaNumeric'; //TODO temp variable
            if ($qSelectors[ 'seflag' ] !== NULL)
            {
                $typeObject = type::build(
                    $type2,
                    $qSelectors[ 'se' ],
                    $qSelectors[ 'seflag' ]
                );
            }
            else
            {
                $typeObject = type::build(
                    $type2,
                    $qSelectors[ 'se' ],
                    null
                );
            }
        }
        return $typeObject;
    }

}