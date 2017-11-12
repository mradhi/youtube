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

### Available Options:

```php

use Mate\Package\Youtube\Args\AvailableArgs as ArgOptions;
use Mate\Package\Youtube\Options;

new Mate\Package\Youtube\Youtube([
     Options::URL               => 'https://www.youtube.com/watch?v=HG713VfiXYAD', // REQUIRED
     Options::OUTPUT_FILENAME   => 'test', // REQUIRED
     Options::OUTPUT_DIRECTORY  => '/var/www/html/youtube-dl/mp3', // REQUIRED
     ArgOptions::SLEEP_INTERVAL => 2,
     ArgOptions::AUDIO_QUALITY  => 6,
     ArgOptions::AUDIO_FORMAT   => 'mp3',
     ArgOptions::EXTRACT_AUDIO  => true,
     ArgOptions::NO_PART        => true,
     ArgOptions::QUIET          => true,
     ArgOptions::SIMULATE       => false,
     ArgOptions::FLAT_PLAYLIST  => false
]);

```

Check `Mate\Package\Youtube\Options` for the available options and `Mate\Package\Youtube\Args\AvailableArgs` for the available arguments.

