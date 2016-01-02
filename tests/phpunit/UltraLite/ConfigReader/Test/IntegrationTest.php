<?php
namespace UltraLite\ConfigReader\Test;

use PHPUnit_Framework_TestCase as TestCase;
use UltraLite\ConfigReader\ConfigReader;

class IntegrationTest extends TestCase
{
    /** @var ConfigReader */
    private $configReader;

    /** @var string */
    private $pathToFixtures;

    public function setUp()
    {
        $this->configReader = new ConfigReader();

        $this->pathToFixtures = realpath(__DIR__ . '/../../../fixtures/') . '/';

        chmod($this->pathToFixtures . 'unreadable.json', 0000);
    }

    public function tearDown()
    {
        chmod($this->pathToFixtures . '/unreadable.json', 0644);
    }

    public function testItThrowsAnExceptionWhenFileIsNotReadable()
    {
        $this->setExpectedException('\UltraLite\ConfigReader\Exception\FileNotReadable');
        $this->configReader->getConfigArray($this->pathToFixtures . 'unreadable.json');
    }

    public function testItThrowsAnExceptionWhenFileFormatNotRecognised()
    {
        $this->setExpectedException('\UltraLite\ConfigReader\Exception\FileFormatNotSupported');
        $this->configReader->getConfigArray($this->pathToFixtures . 'unsupported-format.yml');
    }

    /**
     * @dataProvider provideExampleFiles
     */
    public function testItCanReadExampleFiles(string $fileName, string $errorMessage)
    {
        $expectedResult = [
            'root' => [
                'node' => 'value'
            ]
        ];

        $result = $this->configReader->getConfigArray($this->pathToFixtures . $fileName);

        $this->assertEquals($expectedResult, $result, $errorMessage);
    }

    public function provideExampleFiles()
    {
        return [
            ['example.ini',  'Error parsing .ini file'],
            ['example.json', 'Error parsing JSON file'],
            ['example.php',  'Error parsing php array file'],
        ];
    }
}
