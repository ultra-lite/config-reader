[![Build Status](https://travis-ci.org/ultra-lite/config-reader.svg?branch=master)](https://travis-ci.org/ultra-lite/config-reader)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ultra-lite/config-reader/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/ultra-lite/config-reader/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/ultra-lite/config-reader/v/stable)](https://packagist.org/packages/ultra-lite/config-reader)
[![MIT Licence](https://badges.frapsoft.com/os/mit/mit.svg?v=103)](https://opensource.org/licenses/mit-license.php)

# ![logo](https://avatars1.githubusercontent.com/u/16309098?v=3&s=100) Ultra-Lite Config Reader

An ultra-lightweight config file parser.

## Usage

```php
$configReader = new \UltraLite\ConfigReader\ConfigReader;
$array = $configReader->getConfigArray('/path/to/file.json');
```

## Error Handling

If there is a problem, it (only) throws an ```\UltraLite\ConfigReader\Exception\ConfigReaderException``` of some kind.

## Supported File Types

```.json```, ```.ini``` and ```.php``` 'return array' files are supported.
To be part of the UltraLite project, it is quite lightweight, but it can be extended to support other file types.  Just
come up with your own implementation of ```\UltraLite\ConfigReader\FileParser```:

```php
$customFileParser = new MyXmlFileParser();
$configReader->addFileParser($customFileParser);
$array = $configReader->getConfigArray('/path/to/file.xml');
```
