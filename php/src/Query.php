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
use RestQuery\Model\Type\TypeFactory as type;

class Query implements QueryInterface
{
    public $qSelectors = array(); //TODO seal this as private
    private $primary;
    private $secondary;
    private $qParameters = array(
        'enable_hinting' => 1, //enable by default
        'enable_auto_wildcard' => 1, //enabled by default
    );

    public function getPr() : object
    {
        return $this->primary;
    }

    public function getSe() : object
    {
        return $this->secondary;
    }


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
         * TODO: use exceptions here in the constructor
         * pull the error logic out of the called functions
         *
         */

        /*
         * 1) Filter returns qSelector array with format of [pr][rawString]
         * 2) Cast empty values to null
         * 3) Validate selectors (exit if invalid)
         * 4) Filter and store parameters
         * 5) call typefactory for primary and secondary selectors
         */

        $qSelectors = f::FilterCharacters();
        $this->qSelectors = IfEmpty::CastEmptyToNull($qSelectors);
        v::ValidateSelectors($this->qSelectors);

        $this->qParameters = options::AssignOptionFlags();

        //TODO parse input, assign type, create objects, then store them in Query

        $type1 = 'AlphaNumeric'; //TODO temp variable
        $this->primary = type::build(
            $type1,
            $this->qSelectors['pr']['rawString'],
            $this->qSelectors['prflag']['rawString']
        );

        $type2 = 'AlphaNumeric'; //TODO temp variable
        $this->primary = type::build(
            $type2,
            $this->qSelectors['se']['rawString'],
            $this->qSelectors['seflag']['rawString']
        );
    }
}