<?php

namespace RestQuery\Action\Setup;

use RestQuery\Model\Type\AbstractType;
use RestQuery\Model\Type\TypeFactory as type;

class AssignTypeFor
{
//TODO put logic in here to check for flags and build object correctly
    public static function Primary(array $qSelectors) //return object
    {
        $type1 = 'AlphaNumeric'; //TODO temp variable
        return type::build(
            $type1,
            $qSelectors[ 'pr' ][ 'rawString' ]
        );
        //TODO need logic to include flag
    }

    public static function Secondary(array $qSelectors) //return object
    {
        $type2 = 'AlphaNumeric'; //TODO temp variable
        return type::build(
            $type2,
            $qSelectors[ 'se' ][ 'rawString' ]
        );
        //TODO need logic to include flag
    }
}