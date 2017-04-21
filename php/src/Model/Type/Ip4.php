<?php
namespace RestQuery\Model\Type;

/*
 * canonical IPv4 address with integers of range 0-255 separated by dots
 *
 */

use RestQuery\Model\Type\AbstractType as type;

class Ip4 extends type
{
    use CanReportType;

}