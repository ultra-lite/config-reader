<?php
namespace UltraLite\ConfigReader\Test;

use PHPUnit\Framework\TestCase;
use UltraLite\ConfigReader\ConfigReader;
use UltraLite\ConfigReader\ConfigReaderException\ConfigFileUnparsable;
use UltraLite\ConfigReader\ConfigReaderException\ConfigParsingThrewError;
use UltraLite\ConfigReader\ConfigReaderException\FileFormatNotSupported;
use UltraLite\ConfigReader\ConfigReaderException\FileNotReadable;

class ErrorHandlingIntegrationTest extends TestCase
{
    /** @var ConfigReader */
    private $configReader;

    public function setUp()
    {
        $this->configReader = new ConfigReader();
        chmod(FIXTURE_FOLDER . 'unreadable.json', 0000);
    }

    public function tearDown()
    {
        chmod(FIXTURE_FOLDER . 'unreadable.json', 0644);
    }

    public function testItThrowsAnExceptionWhenFileIsNotReadable()
    {
        $this->expectException(FileNotReadable::class);
        $this->configReader->getConfigArray(FIXTURE_FOLDER . 'unreadable.json');
    }

    public function testItThrowsAnExceptionWhenFileFormatNotRecognised()
    {
        $this->expectException(FileFormatNotSupported::class);
        $this->configReader->getConfigArray(FIXTURE_FOLDER . 'unsupported-format.yml');
    }

    public function testItThrowsAnExceptionWhenParsingInvalidJson()
    {
        $this->expectException(ConfigFileUnparsable::class);
        $this->configReader->getConfigArray(FIXTURE_FOLDER . 'invalid.json');
    }

    public function testItThrowsAnExceptionWhenParsingInvalidIni()
    {
        $this->expectException(ConfigFileUnparsable::class);
        $this->configReader->getConfigArray(FIXTURE_FOLDER . 'invalid.ini');
    }
}
