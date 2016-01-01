<?php
namespace UltraLite\ConfigReader\ConfigFile;

use UltraLite\ConfigReader\ConfigFile;
use UltraLite\ConfigReader\Path;

class JsonFile implements ConfigFile
{
    private $path;

    public function __construct(Path $path)
    {
        $this->path = $path;
    }

    public function toArray(): array
    {
        $contents = file_get_contents($this->path->__toString());
        $contentsArray = json_decode($contents, true);
        return $contentsArray;
    }
}
