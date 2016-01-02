<?php
namespace UltraLite\ConfigReader;

use UltraLite\ConfigReader\Exception\ConfigReaderException;
use UltraLite\ConfigReader\Exception\FileFormatNotSupported;
use UltraLite\ConfigReader\Exception\FileNotReadable;

class ConfigReader
{
    /**
     * @throws ConfigReaderException
     */
    public function getConfigArray(string $pathToConfig): array
    {
        if (!is_readable($pathToConfig)) {
            throw FileNotReadable::constructFromPath($pathToConfig);
        }

        $pathInfo = pathinfo($pathToConfig);
        $extension = $pathInfo['extension'];

        switch ($extension) {
            case 'php':
                return require $pathToConfig;
            case 'json':
                return json_decode(file_get_contents($pathToConfig), true);
            case 'ini':
                return parse_ini_file($pathToConfig);
            default:
                throw FileFormatNotSupported::constructFromPath($pathToConfig);
        }
    }
}
