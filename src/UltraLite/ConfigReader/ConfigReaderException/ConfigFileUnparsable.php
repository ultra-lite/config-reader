<?php
namespace UltraLite\ConfigReader\ConfigReaderException;

use UltraLite\ConfigReader\ConfigReaderException;

class ConfigFileUnparsable extends \RuntimeException implements ConfigReaderException
{
    public static function constructFromPath(string $path): ConfigFileUnparsable
    {
        $message = "Config file not parsable: '$path'";
        return new static($message);
    }

    public static function constructFromThrowable(\Throwable $throwable, string $path): ConfigFileUnparsable
    {
        $message = 'Encountered error parsing config file "' . $path . '". Message was: "' . $throwable->getMessage() .'"';
        return new static($message, $throwable->getCode(), $throwable);
    }
}
