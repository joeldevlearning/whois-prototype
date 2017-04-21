<?php
namespace RestQuery\Model\Type;

/*
 * First portion of an IPv4 address
 * not sure how to use this
 */

use RestQuery\Model\Type\AbstractType as type;

class Ip4Partial extends type
{
    use CanReportType;
}