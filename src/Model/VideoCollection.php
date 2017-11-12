<?php

namespace Mate\Package\Youtube\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class VideoCollection implements VideoCollectionInterface
{
    /** @var Collection */
    protected $videos;

    public function __construct()
    {
        $this->videos = new ArrayCollection();
    }

    public function add( VideoInterface $video): void
    {
        if ($this->videos->contains($video)) {
            return;
        }

        $this->videos->add($video);
    }

    public function remove( VideoInterface $video): void
    {
        if (! $this->videos->contains($video)) {
            return;
        }

        $this->videos->removeElement($video);
    }

    public function all(): Collection
    {
        return $this->videos;
    }

    public function count(): int
    {
        return $this->videos->count();
    }

    public function first(): ?VideoInterface
    {
        return $this->videos->first();
    }
}