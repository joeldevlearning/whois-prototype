<?php
namespace RestQuery\Model\Type;

/*
 * Numeric string in the format whois-RWS prefers, e.g. YYYY-DD-MM
 */

class NumericDate extends AbstractType
{
    use CanReportType;
}