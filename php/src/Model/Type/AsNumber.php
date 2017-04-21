<?php
namespace RestQuery\Model\Type;

/*
 * ARIN-RWS Autonomous System number, e.g. AS......
 *
 */

use RestQuery\Model\Type\AbstractType as type;

class AsNumber extends type
{
    use CanReportType;
}