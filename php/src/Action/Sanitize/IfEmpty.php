<?php


namespace RestQuery\Action\Sanitize;


class IfEmpty
{
    public static function CastEmptyToNull(array $qSelectors) : array
    {
        if (empty($qSelectors[ 'pr' ])) {
            $qSelectors[ 'pr' ] = null;
        }
        if (empty($qSelectors[ 'prflag' ])) {
            $qSelectors[ 'prflag' ] = null;
        }
        if (empty($qSelectors[ 'se' ])) {
            $qSelectors[ 'se' ] = null;
        }
        if (empty($qSelectors[ 'seflag' ])) {
            $qSelectors[ 'seflag' ] = null;
        }

    }
}