<?php
namespace UltraLite\ConfigReader\ConfigFile;

use UltraLite\ConfigReader\ConfigFile;
use UltraLite\ConfigReader\Exception\FileFormatNotSupported;
use UltraLite\ConfigReader\Path;

class Factory
{
    public function buildConfigFileObject(Path $path): ConfigFile
    {
        switch ($path->fileExtension()) {
            case 'ini':
                return new IniFile($path);
            case 'json':
                return new JsonFile($path);
            case 'php':
                return new PhpArrayFile($path);
            default:
                throw FileFormatNotSupported::constructFromPath($path->__toString());
        }
    }
}
