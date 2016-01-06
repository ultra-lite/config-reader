[![Build Status](https://travis-ci.org/ultra-lite/container.svg?branch=master)](https://travis-ci.org/ultra-lite/container)

# Ultra-Lite Config Reader

An ultra-lightweight DI container, filling a Pimple-shaped gap in a Container-Interop world.

## Usage

```php
$configReader = new \UltraLite\ConfigReader\ConfigReader;
$array = $configReader->getConfigArray('/path/to/config/file');
```

## Error Handling

If there is a problem, it (only) throws an ```\UltraLite\ConfigReader\Exception\ConfigReaderException``` of some kind.

## Supported File Types

```.json```, ```.ini``` and ```.php``` 'return array' files are supported.
