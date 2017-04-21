<?php
namespace RestQuery\Model\Type;

/*
 * canonical IPv6 CIDR with a forward slash, e.g. xx:xx:xx:xx/yy
 *
 */

use RestQuery\Model\Type\AbstractType as type;

class Cidr6 extends AbstractType
{
    use CanReportType;
}