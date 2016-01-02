<?php
namespace UltraLite\ConfigReader\ConfigReaderException;

use UltraLite\ConfigReader\ConfigReaderException;

class FileFormatNotSupported extends \InvalidArgumentException implements ConfigReaderException
{
    public static function constructFromPath(string $path): FileFormatNotSupported
    {
        $message = "Config file format not supported: '$path'";
        return new static($message);
    }
}
