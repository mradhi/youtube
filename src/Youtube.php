<?php

namespace Mate\Package\Youtube;

use Mate\Package\Youtube\Args\Arg;
use Mate\Package\Youtube\Args\ArgsCollection;
use Mate\Package\Youtube\Deserializer\VideoDeserializer;
use Mate\Package\Youtube\Model\Video;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Mate\Package\Youtube\Args\AvailableArgs as ArgOptions;
use Mate\Package\Youtube\Process\DownloadProcess;
use Mate\Package\Youtube\Process\CollectProcess;
use Mate\Package\Youtube\Process\ProcessInterface;

class Youtube implements YoutubeInterface
{
    /** @var array */
    protected static $availableOptions = [
        ArgOptions::FLAT_PLAYLIST,
        ArgOptions::SIMULATE,
        ArgOptions::QUIET,
        ArgOptions::NO_PART,
        ArgOptions::AUDIO_FORMAT,
        ArgOptions::AUDIO_QUALITY,
        ArgOptions::EXTRACT_AUDIO,
        ArgOptions::DUMP_SINGLE_JSON,
        ArgOptions::NO_CALL_HOME,
        ArgOptions::NO_WARNING,
        ArgOptions::SLEEP_INTERVAL,
        ArgOptions::OUTPUT
    ];

    /** @var array */
    protected $options;

    /** @var Video|null */
    protected $video;

    public function __construct( array $options = [] )
    {
        $resolver = new OptionsResolver();

        $this->configureOptions( $resolver );

        $this->options = $resolver->resolve( $options );
    }

    public function processDownload( int $timeout = 60 )
    {
        $argsCollection = new ArgsCollection();

        foreach ( $this->options as $name => $value ) {
            if ( in_array( $name, self::$availableOptions, true ) ) {
                $argsCollection->add( new Arg( $name, $value ) );
            }
        }

        $this->prepareOutputArg( $argsCollection );

        $command = new Command( $this->getUrl(), $argsCollection );

        return $this->process( new DownloadProcess( $command, $timeout ) );
    }

    public function isValidURL(): bool
    {
        return (bool) $this->processCollect();
    }

    public function isPlaylist(): bool
    {
        if ( $video = $this->prepareVideo() ) {
            return is_int( strpos( $video->getExtractor(), 'playlist' ) );
        }

        return false;
    }

    public function getVideo(): ?Video
    {
        if (!$this->isValidURL() || $this->isPlaylist()) {
            return null;
        }

        return $this->video;
    }

    protected function prepareVideo(): ?Video
    {
        return $this->processCollect();
    }


    protected function processCollect( int $timeout = 60 ): ?Video
    {
        if ( null !== $this->video ) {
            return $this->video;
        }

        $argsCollection = new ArgsCollection();

        // Build args collection for the collect process (only info)
        $argsCollection
            ->add( new Arg( ArgOptions::SIMULATE ) )
            ->add( new Arg( ArgOptions::FLAT_PLAYLIST ) )
            ->add( new Arg( ArgOptions::DUMP_SINGLE_JSON ) )
            ->add( new Arg( ArgOptions::QUIET ) )
            ->add( new Arg( ArgOptions::NO_CALL_HOME ) );

        $command = new Command( $this->getUrl(), $argsCollection );

        $output = $this->process( new CollectProcess( $command, $timeout ), true );

        if ( !$output ) {
            return null;
        }

        $deserializer = new VideoDeserializer();

        $this->video  = $deserializer->deserialize( $output );

        return $this->video;
    }

    /**
     * This method used for processDownload() func.
     *
     * @param ArgsCollection $argsCollection
     */
    protected function prepareOutputArg( ArgsCollection $argsCollection ): void
    {
        $outputArgValue = sprintf( '"%s/%s.%%(ext)s"', $this->getFilePath(), $this->getFilename() );

        $argsCollection->add( new Arg( ArgOptions::OUTPUT, $outputArgValue ) );
    }

    private function process( ProcessInterface $process, $expectedJSON = false )
    {
        return $process->run( $expectedJSON );
    }

    private function getUrl(): string
    {
        return $this->options[ Options::URL ];
    }

    private function getFilename(): string
    {
        return $this->options[ Options::OUTPUT_FILENAME ];
    }

    private function getFilePath(): string
    {
        return $this->options[ Options::OUTPUT_DIRECTORY ];
    }

    private function configureOptions( OptionsResolver $resolver ): void
    {
        $resolver->setDefaults( [
            ArgOptions::SLEEP_INTERVAL => 2,
            ArgOptions::AUDIO_QUALITY  => 6,
            ArgOptions::AUDIO_FORMAT   => 'mp3',
            ArgOptions::EXTRACT_AUDIO  => true,
            ArgOptions::NO_PART        => true,
            ArgOptions::QUIET          => true,
            ArgOptions::SIMULATE       => false,
            ArgOptions::FLAT_PLAYLIST  => false,
        ] );

        $resolver->setRequired( [ Options::URL, Options::OUTPUT_DIRECTORY, Options::OUTPUT_FILENAME ] );
    }
}