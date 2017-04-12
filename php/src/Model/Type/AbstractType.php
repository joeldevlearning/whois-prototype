<?php

namespace RestQuery\Model\Type;

/*
 * Base definition of all types
 * User input (Primary and Secondary) is stored in a type that extends AbstractType
 *
 */

class AbstractType implements AbstractTypeInterface
{
    protected $type;
    protected $value;
    protected $flag;

    public function getType(): string
    {
        return $this->getClass($stripNamespace = 'true');
    }

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

    public function create()
    {
        return new self($this->type, $this->value);
    }

    /*
     * strip the namespace from the results of get_class()
     * borrowed from http://php.net/manual/en/function.get-class.php#114568
     */
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

    public function __construct(string $type, string $value)
    {
        $this->type = $type;
        $this->value = $value;
    }

}