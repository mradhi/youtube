<?php


namespace Mate\Package\Youtube\Process;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process as Processor;

abstract class Process
{
    abstract protected function getCommand(): string;

    abstract protected function getTimeout(): ?int;

    /**
     * @param bool $expectedJSON
     *
     * @return false|string
     *
     * @throws \Exception
     */
    public function run(bool $expectedJSON = false)
    {
        // create the processor instance
        $processor = new Processor( $this->getCommand() );
        $processor->setTimeout( $this->getTimeout() );

        // run the processor
        $processor->run();

        try {
            $processor->mustRun();

            $output = $processor->getOutput();

            if (! $expectedJSON) {
                return $output;
            }

            if ($expectedJSON && $this->isJSON($output)) {
                return $output;
            }

        } catch ( ProcessFailedException $e ) {
            return $e->getMessage();
        }

        return false;
    }

    private function isJSON($string): bool
    {
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() === JSON_ERROR_NONE);
    }
}