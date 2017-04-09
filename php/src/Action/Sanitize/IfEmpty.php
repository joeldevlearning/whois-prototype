<?php
namespace RestQuery\Action\Sanitize;

/*
 * Casts empty selectors in array to null
 *
 */

class IfEmpty
{
    public static function CastEmptyToNull(array $qSelectors) : array
    {
        if (empty($qSelectors[ 'pr' ][ 'rawString' ])) {
            $qSelectors[ 'pr' ][ 'rawString' ] = null;
        }
        if (empty($qSelectors[ 'prflag' ][ 'rawString' ])) {
            $qSelectors[ 'prflag' ][ 'rawString' ] = null;
        }
        if (empty($qSelectors[ 'se' ][ 'rawString' ])) {
            $qSelectors[ 'se' ][ 'rawString' ] = null;
        }
        if (empty($qSelectors[ 'seflag' ][ 'rawString' ])) {
            $qSelectors[ 'seflag' ][ 'rawString' ] = null;
        }

        return $qSelectors;

    }
}