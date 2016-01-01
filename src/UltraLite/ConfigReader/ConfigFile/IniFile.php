<?php
namespace UltraLite\ConfigReader\ConfigFile;

use UltraLite\ConfigReader\ConfigFile;
use UltraLite\ConfigReader\Path;

class IniFile implements ConfigFile
{
    private $path;

    public function __construct(Path $path)
    {
        $this->path = $path;
    }

    public function toArray(): array
    {
        $contents = file_get_contents($this->path->__toString());
        $contentsArray = parse_ini_file($contents);
        return $contentsArray;
    }
}
