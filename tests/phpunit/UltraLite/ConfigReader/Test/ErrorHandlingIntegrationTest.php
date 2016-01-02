<?php
namespace UltraLite\ConfigReader\Test;

use PHPUnit_Framework_TestCase as TestCase;
use UltraLite\ConfigReader\ConfigReader;

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
        $this->setExpectedException('\UltraLite\ConfigReader\ConfigReaderException\FileNotReadable');
        $this->configReader->getConfigArray(FIXTURE_FOLDER . 'unreadable.json');
    }

    public function testItThrowsAnExceptionWhenFileFormatNotRecognised()
    {
        $this->setExpectedException('\UltraLite\ConfigReader\ConfigReaderException\FileFormatNotSupported');
        $this->configReader->getConfigArray(FIXTURE_FOLDER . 'unsupported-format.yml');
    }

    public function testItThrowsAnExceptionWhenParsingInvalidJson()
    {
        $this->setExpectedException('\UltraLite\ConfigReader\ConfigReaderException\ConfigParsingThrewError');
        $this->configReader->getConfigArray(FIXTURE_FOLDER . 'invalid.json');
    }

    public function testItThrowsAnExceptionWhenParsingInvalidIni()
    {
        $this->setExpectedException('\UltraLite\ConfigReader\ConfigReaderException\ConfigParsingThrewError');
        $this->configReader->getConfigArray(FIXTURE_FOLDER . 'invalid.ini');
    }
}
