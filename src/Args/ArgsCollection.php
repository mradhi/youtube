<?php


namespace Mate\Package\Youtube\Args;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class ArgsCollection
{
    /** @var Collection */
    protected $args;

    public function __construct()
    {
        $this->args = new ArrayCollection();
    }

    public function add(Arg $arg): self
    {
        if ($this->args->contains($arg)) {
            return $this;
        }

        $this->args->add($arg);

        return $this;
    }

    public function remove(Arg $arg): void
    {
        if (! $this->args->contains($arg)) {
            return;
        }

        $this->args->removeElement($arg);
    }

    public function get(string $name): ?Arg
    {
        /** @var Arg $arg */
        foreach ($this->args as $arg) {
            if ($arg->getName() === $name) return $arg;
        }

        return null;
    }

    public function all(): Collection
    {
        return $this->args;
    }

}