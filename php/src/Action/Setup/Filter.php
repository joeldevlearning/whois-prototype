<?php
/*
 * Sanitize "special" characters
 * Wrapper for PHP's built-in filter_input()
 *
 */

namespace RestQuery\Action\Setup;


class Filter
{
    public static function httpGetSelectors(): array
    {
        /*
         * Remove HTML/XML/PHP tags
         * Strip out ASCII characters <32
         * Cast empty to NULL
         */
        $filterGet = function($input)
        {
            return filter_input(INPUT_GET, $input,
                FILTER_SANITIZE_STRING,
                FILTER_FLAG_EMPTY_STRING_NULL | FILTER_FLAG_STRIP_LOW);
        };

        $qSelectors = [
            "pr"      => $filterGet('pr'),
            "prflag"  => $filterGet('prflag'),
            "se"      => $filterGet('se'),
            "seflag"  => $filterGet('seflag')
        ];

        /*
         * For pr and se, keep white space and asterisk/star, Dash
         */
        $allowAsteriskDash = function($input)
        {
            return preg_replace('/[^a-zA-Z0-9\s\p{Pd}\*]/', "", $input);
        };

        /*
         * For flags, remove all punctuation, math symbols, and invisible characters
         */
        $stripPunctMathInvisible = function($input)
        {
            return preg_replace('/[\p{P}\p{S}\p{C}]/', "", $input);
        };

        /*
         * If filtering empties the string, cast to null
         */
        $qSelectors['pr'] = self::CastEmptyToNull($allowAsteriskDash($qSelectors['pr']));
        $qSelectors['se'] = self::CastEmptyToNull($allowAsteriskDash($qSelectors['se']));

        $qSelectors['prflag'] = self::CastEmptyToNull($stripPunctMathInvisible($qSelectors['prflag']));
        $qSelectors['seflag'] = self::CastEmptyToNull($stripPunctMathInvisible($qSelectors['seflag']));

        return $qSelectors;
    }

    /**
     * @param string $selector
     * @return string or NULL
     */
    private static function CastEmptyToNull(string $selector)
    {
        if(isEmpty::string($selector))
        {
            $selector = NULL;
        }
        return $selector;
    }

    public static function httpGetParameters(): array
    {
        $qParameters = array(
            'enable_hinting' => 1, //enable by default
            'enable_auto_wildcard' => 1, //enabled by default
        );

        $hintFlag = filter_input(INPUT_GET, 'hint', FILTER_VALIDATE_INT);
        if ($hintFlag == false || $hintFlag == null)
        {
            //do nothing, default remains at 1
        }
        if ($hintFlag === 0)
        {
            $qParameters[ 'enable_hinting' ] = 0;
        }
        else
            {/*do nothing, default remains at 1*/
        }

        $wildCardFlag = filter_input(INPUT_GET, 'wildcard', FILTER_VALIDATE_INT);
        if ($wildCardFlag === 0)
        {
            $qParameters[ 'enable_auto_wildcard' ] = 0;
        }
        else
            {/*do nothing, default remains at 1*/
        }
        return $qParameters;
    }
}