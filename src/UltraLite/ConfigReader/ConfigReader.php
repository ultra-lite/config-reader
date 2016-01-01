<?php
namespace UltraLite\ConfigReader;

use UltraLite\ConfigReader\ConfigFile\Factory as ConfigFileFactory;
use UltraLite\ConfigReader\Exception\ConfigReaderException;

class ConfigReader
{
    private $configFileFactory;

    public function __construct(ConfigFileFactory $configFileFactory = null)
    {
        $this->configFileFactory = $configFileFactory ?: new ConfigFileFactory();
    }

    /**
     * @throws ConfigReaderException
     */
    public function getConfigArray(string $pathToConfig): array
    {
        $path = new Path($pathToConfig);
        $configFile = $this->configFileFactory->buildConfigFileObject($path);
        return $configFile->toArray();
    }
}
