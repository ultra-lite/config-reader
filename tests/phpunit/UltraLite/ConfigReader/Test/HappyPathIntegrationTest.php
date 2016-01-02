<?php
namespace UltraLite\ConfigReader\Test;

use PHPUnit_Framework_TestCase as TestCase;
use UltraLite\ConfigReader\ConfigReader;

class HappyPathIntegrationTest extends TestCase
{
    /** @var ConfigReader */
    private $configReader;

    public function setUp()
    {
        $this->configReader = new ConfigReader();
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

        $result = $this->configReader->getConfigArray(FIXTURE_FOLDER . $fileName);

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
