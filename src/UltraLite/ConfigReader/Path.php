<?php
namespace UltraLite\ConfigReader;

use UltraLite\ConfigReader\Exception\ConfigReaderException;
use UltraLite\ConfigReader\Exception\FileFormatNotSupported;
use UltraLite\ConfigReader\Exception\FileNotReadable;

class Path
{
    /** @var string */
    private $stringRepresentation;

    private $supportedFileExtensions = ['json', 'php', 'ini'];

    /**
     * @throws ConfigReaderException
     */
    public function __construct(string $stringRepresentation)
    {
        $this->stringRepresentation = $stringRepresentation;
        $this->validate();
    }

    public function __toString(): string
    {
        return realpath($this->stringRepresentation);
    }

    public function fileExtension(): string
    {
        $pathInfo = pathinfo($this->path);
        return $pathInfo['extension'];
    }

    /**
     * @throws ConfigReaderException
     */
    private function validate()
    {
        $this->validatePathReadability();
        $this->validatePathFormat();
    }

    /**
     * @throws ConfigReaderException
     */
    private function validatePathReadability()
    {
        $path = $this->__toString();
        if (!is_readable($path)) {
            throw FileNotReadable::constructFromPath($path);
        }
    }

    /**
     * @throws ConfigReaderException
     */
    private function validatePathFormat()
    {
        $extension = $this->fileExtension();
        $path = $this->__toString();

        if (!in_array($extension, $this->supportedFileExtensions)) {
            throw FileFormatNotSupported::constructFromPath($path);
        }
    }
}
