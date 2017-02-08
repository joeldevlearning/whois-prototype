<?php
namespace RestQuery\Model\Type;

/*
 * ARIN Point of Contact Handle, e.g. DOE123-ARIN
 * ARIN's documentation says that some poc handles are NOT suffixed with -ARIN
 * if so, then the type AlphaNumeric is assigned
 */

use RestQuery\Model\Type\AbtractType as type;

class PocHandle extends type
{


}