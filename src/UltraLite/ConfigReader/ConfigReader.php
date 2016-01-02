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
        $this->verifyIsReadable($pathToConfig);
        $extension = $this->getExtension($pathToConfig);
        return $this->getContentsAsArray($pathToConfig, $extension);
    }

    private function verifyIsReadable(string $path)
    {
        if (!is_readable($path)) {
            throw FileNotReadable::constructFromPath($path);
        }
    }

    private function getExtension($path): string
    {
        $pathInfo = pathinfo($path);
        return $pathInfo['extension'];
    }

    private function getContentsAsArray(string $path, string $fileExtension): array
    {
        switch ($fileExtension) {
            case 'php':
                return require $path;
            case 'json':
                return json_decode(file_get_contents($path), true);
            case 'ini':
                return parse_ini_file($path);
            default:
                throw FileFormatNotSupported::constructFromPath($path);
        }
    }
}
