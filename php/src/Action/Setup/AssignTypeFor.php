<?php

namespace RestQuery\Action\Setup;

use RestQuery\Model\Type\TypeFactory as type;

class AssignTypeFor
{
//TODO put logic in here to check for flags and build object correctly
    public static function Primary()
    {
        $type1 = 'AlphaNumeric'; //TODO temp variable
        $primary = type::build(
            $type1,
            $qSelectors[ 'pr' ][ 'rawString' ]
        );
    }

    public static function Secondary()
    {
        $type1 = 'AlphaNumeric'; //TODO temp variable
        $primary = type::build(
            $type1,
            $qSelectors[ 'pr' ][ 'rawString' ]
        );
    }
}