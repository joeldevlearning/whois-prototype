<?php
namespace RestQuery\Model\Type;

/*
 * ARIN-RWS Autonomous System number, e.g. AS......
 *
 */

use RestQuery\Model\Type\AbstractType;

class AsNumber extends AbstractType
{
    use CanReportType;
}