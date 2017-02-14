[![Build Status](https://travis-ci.org/ultra-lite/config-reader.svg?branch=master)](https://travis-ci.org/ultra-lite/config-reader)

# Ultra-Lite Config Reader

An ultra-lightweight DI container, filling a Pimple-shaped gap in a Container-Interop world.

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
