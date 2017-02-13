<?php
namespace UltraLite\ConfigReader;

use UltraLite\ConfigReader\ConfigReaderException\ConfigParsingThrewError;
use UltraLite\ConfigReader\ConfigReaderException\FileFormatNotSupported;
use UltraLite\ConfigReader\ConfigReaderException\FileNotReadable;

class ConfigReader
{
    /**
     * @throws ConfigReaderException
     */
    public function getConfigArray(string $pathToConfig): array
    {
        $this->assertIsReadable($pathToConfig);
        $extension = $this->getExtension($pathToConfig);

        try {
            return $this->getContentsAsArray($pathToConfig, $extension);
        } catch (ConfigReaderException $configReaderException) {
            throw $configReaderException;
        } catch (\Throwable $throwable) {
            throw ConfigParsingThrewError::constructFromThrowable($throwable);
        }
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

    private function assertIsReadable(string $path)
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
}
