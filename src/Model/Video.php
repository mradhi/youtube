<?php

namespace Mate\Package\Youtube\Model;

class Video implements VideoInterface
{
    /** @var string|null */
    protected $id;

    /** @var string|null */
    protected $title;

    /** @var string|null */
    protected $description;

    /** @var int|null */
    protected $viewCount;

    /** @var string|null */
    protected $extractor;

    /** @var int|null */
    protected $duration;

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId( string $id )
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle( string $title )
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription( string $description )
    {
        $this->description = $description;
    }

    /**
     * @return int|null
     */
    public function getViewCount(): ?int
    {
        return $this->viewCount;
    }

    /**
     * @param int $viewCount
     */
    public function setViewCount( int $viewCount )
    {
        $this->viewCount = $viewCount;
    }

    /**
     * @return string|null
     */
    public function getExtractor(): ?string
    {
        return $this->extractor;
    }

    /**
     * @param string $extractor
     */
    public function setExtractor( string $extractor )
    {
        $this->extractor = $extractor;
    }

    /**
     * @return int|null
     */
    public function getDuration(): ?int
    {
        return $this->duration;
    }

    /**
     * @param int $duration
     */
    public function setDuration( int $duration )
    {
        $this->duration = $duration;
    }
}