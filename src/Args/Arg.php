<?php


namespace Mate\Package\Youtube\Args;

class Arg
{
    /** @var string */
    protected $name;

    /** @var mixed */
    protected $value;

    public function __construct( string $name, $value = true )
    {
        $this->name  = $name;
        $this->value = $value;
    }

    public function __toString()
    {
        if ($value = $this->getValue()) {
            if (is_bool($value)) {
                return sprintf('--%s', $this->getName());
            }

            if (is_string($value) || is_int($value)) {
                return sprintf('--%s %s', $this->getName(), $value);
            }
        }

        return '';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}