<?php
namespace UltraLite\ConfigReader\Exception;

class ConfigParsingThrewError extends \RuntimeException implements ConfigReaderException
{
    public static function constructFromThrowable(\Throwable $throwable): ConfigParsingThrewError
    {
        $message = 'Encountered error parsing config. Message was: "' . $throwable->getMessage() .'"';
        return new static($message, $throwable->getCode(), $throwable);
    }
}
