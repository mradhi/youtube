<?php


namespace Mate\Package\Youtube\Process;

class DownloadProcess extends Process implements DownloadProcessInterface
{
    /** @var string */
    protected $command;

    /** @var int|null */
    protected $timeout;

    public function __construct(string $command, ?int $timeout)
    {
        $this->command = $command;
        $this->timeout = $timeout;
    }

    /**
     * @return string
     */
    public function getCommand(): string
    {
        return $this->command;
    }

    /**
     * @return null|int
     */
    public function getTimeout(): ?int
    {
        return $this->timeout;
    }

    //
}