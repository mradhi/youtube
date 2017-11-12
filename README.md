# Youtube Library based on Youtube-DL
Youtube library to get video informations and download with multiple format based on Youtube-DL

# youtube-dl
 Youtube downloader helper for PHP

### Usage:

```php

$youtube = new Mate\Package\Youtube\Youtube([
    'url'              => 'https://www.youtube.com/watch?v=HG713VfiXYAD',
    'output_filename'  => 'test',
    'output_directory' => '/var/www/html/youtube-dl/mp3'
]);

/** @var Mate\Package\Youtube\Model\Video $video */
$video = $youtube->getVideo();

echo $video->getId();
echo $video->getTitle();
echo $video->getDuration();
echo $video->getViewCount();
...

echo $youtube->isValidURL(); // TRUE
echo $youtube->isPlaylist(); // FALSE


$youtube->download();

// ...

```
