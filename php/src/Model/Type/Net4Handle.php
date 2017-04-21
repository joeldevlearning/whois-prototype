<?php
namespace RestQuery\Model\Type;

/*
 * ARIN-RWS NET handle for IPv4 address blocks, e.g. NET-xx-xx-xx-x-x
 */

class Net4Handle extends AbstractType
{
    use CanReportType;
}