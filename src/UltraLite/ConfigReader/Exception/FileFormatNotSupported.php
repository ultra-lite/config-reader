<?php
namespace UltraLite\ConfigReader\Exception;

class FileFormatNotSupported extends \InvalidArgumentException implements ConfigReaderException
{
    public static function constructFromPath(string $path): FileFormatNotSupported
    {
        $message = "Config file format not supported: '$path'";
        return new static($message);
    }
}
