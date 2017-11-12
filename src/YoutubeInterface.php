<?php


namespace Mate\Package\Youtube;

use Mate\Package\Youtube\Model\Video;

interface YoutubeInterface
{
    public function getVideo(): ?Video;

    public function processDownload(int $timeout);
}