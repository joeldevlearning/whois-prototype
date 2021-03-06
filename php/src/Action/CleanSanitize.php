<?php
namespace RestQuery\Action;

use RestQuery\Query;
use RestQuery\Action\Respond as respond;
use Respect\Validation\Validator as v;

class CleanSanitize
{
    /**
     * Check length, character encoding, etc. of user input
     * Delegated from Sanitize class
     * @param Query $query
     * @return Query
     */
    public function __invoke(Query $query)
    {
        //create validators
        $stringFilter = v::alnum('*-')->length(1, 101); //allow * and - characters
        $flagFilter = v::alnum()->length(1, 40);

        if ($query->qSelectors[ 'pr' ] !== null) {
            //v::key accepts @param key name AND validator
            if (v::key('pr', $stringFilter)->validate($query->qSelectors) === false) {
                //error, bad input
                respond::InvalidInput();
            }
        }
        if ($query->qSelectors[ 'se' ] !== null) {
            if (!v::key('se', $stringFilter)->validate($query->qSelectors)) {
                //error, bad input
                respond::InvalidInput();
            }
        }
        if ($query->qSelectors[ 'prflag' ] !== null) {
            if (!v::key('prflag', $flagFilter)->validate($query->qSelectors)) {
                //error, bad input
                respond::InvalidInput();
            }
        }
        if ($query->qSelectors[ 'seflag' ] !== null) {
            if (!v::key('seflag', $flagFilter)->validate($query->qSelectors)) {
                //error, bad input
                respond::InvalidInput();
            }
        }
        return $query;
    }
}