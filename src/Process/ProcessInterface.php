<?php


namespace Mate\Package\Youtube\Process;


interface ProcessInterface
{
    public function run(bool $expectedJSON);
}