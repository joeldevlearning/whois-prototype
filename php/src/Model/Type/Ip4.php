<?php
namespace RestQuery\Model\Type;

/*
 * canonical IPv4 address with integers of range 0-255 separated by dots
 */

class Ip4 extends AbstractType
{
    use CanReportType;

}