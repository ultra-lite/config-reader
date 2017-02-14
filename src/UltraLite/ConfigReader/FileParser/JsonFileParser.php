<?php
namespace UltraLite\ConfigReader\FileParser;

use UltraLite\ConfigReader\ConfigReaderException\ConfigFileUnparsable;
use UltraLite\ConfigReader\FileParser;

class JsonFileParser implements FileParser
{
    public function supportsFileExtension(string $fileExtension): bool
    {
        return $fileExtension === 'json';
    }

    /**
     * @throws ConfigFileUnparsable
     */
    public function getFileContentsAsArray(string $path): array
    {
        $fileContents = file_get_contents($path);
        $fileContentsAsArray = json_decode($fileContents, true);
        if (!is_array($fileContentsAsArray)) {
            throw ConfigFileUnparsable::constructFromPath($path);
        }
        return $fileContentsAsArray;
    }
}
