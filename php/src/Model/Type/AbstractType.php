<?php

namespace RestQuery\Model\Type;

/*
 * Base class for all types
 * User input (Primary and Secondary) is stored in a type that extends AbstractType
 *
 */

abstract class AbstractType implements TypeInterface
{
    protected $value;
    protected $flag;

    /* REMOVED in favor of CanReportType trait
    public function getType(): string
    {
        return $this->getClass($stripNamespace = 'true');
    }*/

    public function getValue(): string
    {
        return $this->value;
    }

    public function getFlag(): string
    {
        return $this->flag;
    }

    /**
     * Flag setter
     * Flag is optional, so leave it as a configuration option
     */
    public function setFlag(string $flag): object
    {
        $this->secondary = $flag;
        return $this;
    }

    /*
     * strip the namespace from the results of get_class()
     * borrowed from http://php.net/manual/en/function.get-class.php#114568

    private function getClass(bool $stripNamespace): string
    {
        if ($stripNamespace === true) {
            $NamespaceWithClass = get_class($this);
            if ($pos = strrpos($NamespaceWithClass, '\\')) {
                return substr($NamespaceWithClass, $pos + 1);
            }
            return $pos;
        }
        //else
        return get_class($this);
    }
    */

    public function __construct(string $value, $flag)
    {
        $this->value = $value;
        $this->flag = $flag;
    }

}