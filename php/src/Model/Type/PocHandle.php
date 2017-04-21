<?php
namespace RestQuery\Model\Type;

/*
 * ARIN-RWS Point of Contact Handle, e.g. DOE123-ARIN-RWS
 * ARIN-RWS's documentation says that some poc handles are NOT suffixed with -ARIN-RWS
 * if so, then the type AlphaNumeric is assigned
 */

use RestQuery\Model\Type\AbstractType as type;

class PocHandle extends type
{
    use CanReportType;
}