<?php
namespace RestQuery;

/*
 * Singleton that holds the state of a query
 * Is mutated by various "Action" objects
 */

use RestQuery\Action\Sanitize\Filter as f;
use RestQuery\Action\Sanitize\IfEmpty;
use RestQuery\Action\Sanitize\ProcessOptions as options;
use RestQuery\Action\Validate\Validate as v;

class Query implements QueryInterface
{
    public function SetTypeToken(string $selector, object $typeToken) : void
    {
        switch($selector) {
            case 'pr':
                $this->qSelectors[ 'pr' ][ 'typeToken' ] = $typeToken;
                break;
            case 'se':
                $this->qSelectors[ 'se' ][ 'typedToken' ] = $typeToken;
                break;
        }
    }

    public function getPr() : QuerySelector
    {
        return $this->qSelectors['pr']['typedObject'];
    }

    public function getSe() : QuerySelector
    {
        return $this->qSelectors['se']['typedObject'];
    }

    private $qSelectors = array();
    private $primary;
    private $secondary;

    private $qParameters = array(
        'enable_hinting' => 1, //enable by default
        'enable_auto_wildcard' => 1, //enabled by default
    );
    /* @var integer Indicates what type of hint is available
     * "0" = no hint, hinting disabled
     * "1" = hint available, hinting enabled
     */

    public $hintFlag = "";
    /* @var integer Defines constraints on query, based on user input
     * 1 = only primary search string, no specific record type
     * 2 = only primary search string, ONE specific record type desired
     * 3 = only primary search string, ONE specific record type desired based on matching specific primary record type
     * 4 = primary and secondary search strings, specific record AND field desired
     * set and read by Analyze class
     */
    public $qType = "";

    /* @var array Contains list of records to query
     * should be in the format of [0][recordType=>fieldType]
     */
    public $qBuildQueue = array();

    /*
     * Right now we are pulling directly from qRunQueue
for abstraction we could use an iterator/generator
this would wrap qRunQueue
calls to the RunQueue would return one-by-one results from the array

     */
    public $qRunQueue = array();

    public $qTransformQueue = array();

    public $qReportQueue = array();

    public $qRespondQueue = array();

    public function __construct()
    {

        /*
         * 1) Filter returns qSelector array with format of [pr][rawString]
         * 2) Cast empty values to null
         * 3) Validate selectors (exit if invalid)
         * 4) Filter and store parameters
         * 5) call SetSelector to create selector objects
         */

        $qSelectors = f::FilterCharacters();
        $this->qSelectors = IfEmpty::CastEmptyToNull($qSelectors);
        v::ValidateSelectors($this->qSelectors);

        $this->qParameters = options::AssignOptionFlags();

        $this->primary = new QuerySelector($this->qSelectors['pr']['rawString'],
            $this->qSelectors['prflag']['rawString']);

        $this->secondary = new QuerySelector($this->qSelectors['se']['rawString'],
            $this->qSelectors['seflag']['rawString']);
    }
}