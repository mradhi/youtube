<?php


namespace Mate\Package\Youtube;


use Mate\Package\Youtube\Args\Arg;
use Mate\Package\Youtube\Args\ArgsCollection;

class Command implements CommandInterface
{
    /** @var string */
    protected $url;

    /** @var ArgsCollection */
    protected $argsCollection;

    /** @var null|string */
    private $options = null;

    public function __construct( string $url, ArgsCollection $argsCollection )
    {
        $this->url            = $url;
        $this->argsCollection = $argsCollection;
    }

    public function __toString()
    {
        $options = $this->prepareOptions();

        return sprintf('youtube-dl %s "%s"', $options, $this->url);
    }

    private function prepareOptions(): string
    {
        if (null !== $this->options) {
            return $this->options;
        }

        /** @var Arg $arg */
        foreach ($this->argsCollection->all() as $arg) {
            $this->options .= sprintf('%s ', $arg);
        }

        return $this->options;
    }
}