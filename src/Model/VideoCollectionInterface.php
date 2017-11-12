<?php

namespace Mate\Package\Youtube\Model;

use Doctrine\Common\Collections\Collection;

interface VideoCollectionInterface
{
    public function add( VideoInterface $video): void;

    public function remove( VideoInterface $video): void;

    public function all(): Collection;

    public function count(): int;

    public function first(): ?VideoInterface;
}