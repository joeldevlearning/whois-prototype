<?php
namespace RestQuery\Model\Type;

/*
 * Contains domain with or without email address, e.g. address@domain.TLD
 *
 */

use RestQuery\Model\Type\AbstractType as type;

class EmailDomain extends AbstractType
{
    use CanReportType;
}