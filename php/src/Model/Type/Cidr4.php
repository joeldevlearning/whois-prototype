<?php
namespace RestQuery\Model\Type;

/*
 * canonical IPv4 CIDR with a forward slash, e.g. xx.xx.xx.xx/yy
 *
 */

class Cidr4 extends AbstractType
{
    use CanReportType;
}