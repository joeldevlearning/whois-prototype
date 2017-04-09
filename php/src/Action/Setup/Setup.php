<?php
namespace RestQuery\Action\Setup;

use RestQuery\Query;
use RestQuery\Action\Setup\{Filter, IsEmpty, IsValid, Load};
use RestQuery\Exception\QueryInputWasInvalid;
use RestQuery\Model\Type\TypeFactory as type;

class Setup
{
    //Step 1, filter input
    public static function FilterInput() : array
    {
        return Filter::GetParameters();
    }

    //Step 2, validate input
    public static function ValidateInput($qSelectors)
    {
        if( IsValid::Content($qSelectors) === FALSE ||
            IsValid::Flag($qSelectors) === FALSE ||
            IsValid::Combination($qSelectors) === FALSE
        )
        {
           throw new QueryInputWasInvalid();
        }
    }

    //Step 3, inject selectors and parameters into new Query object
    public static function CreateQuery()
    {
        $qParameters = Load::Parameters();

        $type1 = 'AlphaNumeric'; //TODO temp variable
        $primary = type::build(
            $type1,
            $qSelectors['pr']['rawString'],
            $qSelectors['prflag']['rawString']
        );

        $type2 = 'AlphaNumeric'; //TODO temp variable
        $primary = type::build(
            $type2,
            $qSelectors['se']['rawString'],
            $qSelectors['seflag']['rawString']
        );
    }


}