<?php

namespace Mate\Package\Youtube\Deserializer;


use Mate\Package\Youtube\Model\Video;

class VideoDeserializer extends Deserializer
{
    public function deserialize($json): Video
    {
        return $this->serializer->deserialize($json, Video::class, 'json');
    }
}