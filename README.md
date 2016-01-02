
```php
$configReader = new \UltraLite\ConfigReader\ConfigReader;
$array = $configReader->getConfigArray();
```

If there is a problem, it (only) throws an ```\UltraLite\ConfigReader\Exception\ConfigReaderException``` of some kind.
