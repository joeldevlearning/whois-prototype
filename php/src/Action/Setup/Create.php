<?php

namespace RestQuery\Action\Setup;

use RestQuery\Query;
use RestQuery\Model\Type\TypeFactory as type;

class Create
{
    public static function Selector(string $selector, array $qSelectors) //return object
    {
        $typeObject = NULL;

        //create primary object
        if($selector === 'primary')
        {
            if($qSelectors[ 'pr' ] === NULL)
            {
                return $primary = NULL;
            }

            //assign type
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
            if($qSelectors[ 'se' ] === NULL)
            {
                return $secondary = NULL;
            }

            //assign type
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

    public static function Query($primary, $secondary, array $qParameters) : \RestQuery\Query
    {
        $q = new Query();

        if($secondary !== NULL)
        {
            $q = $q::create()
                ->setPrimary($primary)
                ->setSecondary($secondary)
                ->setParameters($qParameters);
        }
        else
        {
            $q = $q::create()
                ->setPrimary($primary)
                ->setParameters($qParameters);
        }
        return $q;
    }
}