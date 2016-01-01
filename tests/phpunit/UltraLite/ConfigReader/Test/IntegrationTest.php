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
        $this->reader = new ConfigReader();

        $this->pathToFixtures = realpath(__DIR__ . '/../../../fixtures/');

        chmod($this->pathToFixtures . 'unreadable.json', 0000);
    }

    public function tearDown()
    {
        chmod($this->pathToFixtures . 'unreadable.json', 0644);
    }

    public function testItThrowsAnExceptionWhenFileIsNotReadable()
    {
        $this->setExpectedException('\UltraLite\ConfigReader\Exception\FileNotReadable');
        $this->configReader->getConfigArray($this->pathToFixtures . 'unreadable.json');
    }
}
