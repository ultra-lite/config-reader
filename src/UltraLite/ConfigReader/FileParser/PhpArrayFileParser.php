<?php
namespace UltraLite\ConfigReader\FileParser;

use UltraLite\ConfigReader\ConfigReaderException\ConfigFileUnparsable;
use UltraLite\ConfigReader\FileParser;

class PhpArrayFileParser implements FileParser
{
    public function supportsFileExtension(string $fileExtension): bool
    {
        return $fileExtension === 'php';
    }

    /**
     * @throws ConfigFileUnparsable
     */
    public function getFileContentsAsArray(string $path): array
    {
        $contents = require $path;
        if (!is_array($contents)) {
            throw ConfigFileUnparsable::constructFromPath($path);
        }
        return $contents;
    }
}
