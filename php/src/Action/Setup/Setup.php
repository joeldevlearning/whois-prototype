<?php

namespace RestQuery\Action\Setup;

use RestQuery\Action\Setup\{
    Filter, IsEmpty, IsValid
};
use RestQuery\Exception\QueryInputWasInvalid;

class Setup
{
    //Step 1, filter input
    public static function filterSelectors(): array
    {
        return Filter::httpGetSelectors();
    }

    public static function filterParameters(): array
    {
        return Filter::httpGetParameters();
    }

    //Step 2, validate input
    public static function validateInput($qSelectors)
    {
        if (IsValid::content($qSelectors) === false ||
            IsValid::flag($qSelectors) === false ||
            IsValid::combination($qSelectors) === false
        ) {
            throw new QueryInputWasInvalid();
        }
    }

    //Step 3, determine selector types and create selector objects
    public static function castToTypes(array $qSelectors) : array
    {//TODO remove all this logic, simplify
        //state 0, pr only
        if (isEmpty::string($qSelectors[ 'se' ][ 'rawString' ]) &&
            isEmpty::string($qSelectors[ 'prflag' ][ 'rawString' ])
        )
        {
        //define pr object WITHOUT flag
        }

        //state 1, pr+flag, WITHOUT se
        if (isEmpty::string($qSelectors[ 'se' ][ 'rawString' ]) &&
            !isEmpty::string($qSelectors[ 'prflag' ][ 'rawString' ])
        )
        {
            //define pr object WITH flag
        }

        //state 2, pr and se, WITHOUT flags
        if (!isEmpty::string($qSelectors[ 'se' ][ 'rawString' ]) &&
            isEmpty::string($qSelectors[ 'prflag' ][ 'rawString' ]) &&
            isEmpty::string($qSelectors[ 'seflag' ][ 'rawString' ])
        )
        {
            //define pr and se, WITHOUT flags
        }

        //state 3, pr+flag and se WITHOUT flag
        if (!isEmpty::string($qSelectors[ 'se' ][ 'rawString' ]) &&
            !isEmpty::string($qSelectors[ 'prflag' ][ 'rawString' ]) &&
            isEmpty::string($qSelectors[ 'seflag' ][ 'rawString' ])
        )
        {
            //define pr+flag and se WITHOUT flag
        }

        //state 4, pr+flag AND se+flag
        if (!isEmpty::string($qSelectors[ 'se' ][ 'rawString' ]) &&
            !isEmpty::string($qSelectors[ 'prflag' ][ 'rawString' ]) &&
            !isEmpty::string($qSelectors[ 'seflag' ][ 'rawString' ])
        )
        {
            //define pr+flag AND se+flag
        }
    }


}