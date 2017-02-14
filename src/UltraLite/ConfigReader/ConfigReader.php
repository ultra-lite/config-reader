<?php
namespace UltraLite\ConfigReader;

use UltraLite\ConfigReader\ConfigReaderException\FileFormatNotSupported;
use UltraLite\ConfigReader\ConfigReaderException\FileNotReadable;
use UltraLite\ConfigReader\FileParser\IniFileParser;
use UltraLite\ConfigReader\FileParser\JsonFileParser;
use UltraLite\ConfigReader\FileParser\PhpArrayFileParser;

class ConfigReader
{
    /** @var FileParser[] */
    private $fileParsers;

    public function __construct(array $fileParsers = null)
    {
        $this->fileParsers = $fileParsers ?: [new IniFileParser(), new JsonFileParser(), new PhpArrayFileParser()];
    }

    public function addFileParser(FileParser $fileParser)
    {
        $this->fileParsers[] = $fileParser;
    }

    /**
     * @throws ConfigReaderException
     */
    public function getConfigArray(string $pathToConfig): array
    {
        $this->assertIsReadable($pathToConfig);
        return $this->getContentsAsArray($pathToConfig);
    }

    private function getContentsAsArray(string $path): array
    {
        $fileExtension = pathinfo($path)['extension'];

        foreach ($this->fileParsers as $fileParser) {
            if ($fileParser->supportsFileExtension($fileExtension)) {
                return $fileParser->getFileContentsAsArray($path);
            }
        }

        throw FileFormatNotSupported::constructFromPath($path);
    }

    private function assertIsReadable(string $path)
    {
        if (!is_readable($path)) {
            throw FileNotReadable::constructFromPath($path);
        }
    }
}
