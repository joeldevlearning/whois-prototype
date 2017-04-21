<?php
namespace RestQuery\Model\Type;

/*
 * ARIN-RWS NET handle for IPv6 address blocks, e.g. NET6-....
 */

class Net6Handle extends AbstractType
{
    use CanReportType;
}