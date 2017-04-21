<?php
namespace RestQuery\Model\Type;

/*
 * alphanumeric string of the form C1234, variable length
 *
 */

use RestQuery\Model\Type\AbstractType as type;

class CustomerNumber extends type
{
    use CanReportType;
}