<?php

namespace RestQuery\Model\Type;

trait CanReportType
{
    /*
     * strip the namespace from __CLASS__
     * modified from http://php.net/manual/en/function.get-class.php#114568
     */
    public function getType() : string
    {
        $NamespaceWithClass = __CLASS__;
        if ($pos = strrpos($NamespaceWithClass, '\\')) {
            return substr($NamespaceWithClass, $pos + 1);
        }
        return $pos;
    }
}