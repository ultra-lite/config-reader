<?php
namespace UltraLite\ConfigReader\FileParser;

use UltraLite\ConfigReader\ConfigReaderException\ConfigFileUnparsable;
use UltraLite\ConfigReader\FileParser;

class IniFileParser implements FileParser
{
    public function supportsFileExtension(string $fileExtension): bool
    {
        return $fileExtension === 'ini';
    }

    /**
     * @throws ConfigFileUnparsable
     */
    public function getFileContentsAsArray(string $path): array
    {
        try {
            return parse_ini_file($path);
        } catch (\Throwable $throwable) {
            throw ConfigFileUnparsable::constructFromThrowable($throwable, $path);
        }
    }
}
