<?php
namespace RestQuery\Model\Type;

/*
 * First portion of an IPv6 address
 * not sure how to use this
 */

use RestQuery\Model\Type\AbstractType as type;

class Ip6Partial extends type
{
    use CanReportType;
}