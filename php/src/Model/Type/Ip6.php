<?php
namespace RestQuery\Model\Type;

/*
 * canonical IPv6 address with hex values separated by semicolons
 *
 */

use RestQuery\Model\Type\AbstractType as type;

class Ip6 extends type
{
    use CanReportType;
}