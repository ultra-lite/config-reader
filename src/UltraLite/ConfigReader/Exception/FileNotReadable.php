<?php
namespace UltraLite\ConfigReader\Exception;

class FileNotReadable extends \InvalidArgumentException implements ConfigReaderException
{
    public static function constructFromPath(string $path): FileNotReadable
    {
        $message = "Config file format not readable: '$path'";
        return new static($message);
    }
}
