<?php
namespace UltraLite\ConfigReader\ConfigFile;

use UltraLite\ConfigReader\ConfigFile;
use UltraLite\ConfigReader\Path;

class PhpArrayFile implements ConfigFile
{
    private $path;

    public function __construct(Path $path)
    {
        $this->path = $path;
    }

    public function toArray(): array
    {
        $contentsArray = require $this->path->__toString();
        return $contentsArray;
    }
}
