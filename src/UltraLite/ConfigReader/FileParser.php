<?php
namespace UltraLite\ConfigReader;

use UltraLite\ConfigReader\ConfigReaderException\ConfigFileUnparsable;

interface FileParser
{
    public function supportsFileExtension(string $fileExtension): bool;

    /**
     * @throws ConfigFileUnparsable
     */
    public function getFileContentsAsArray(string $path): array;
}
