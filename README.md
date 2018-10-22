# About Dominican Bank Parser

This package allows you to parse files from the major dominican Bank entities.

## Requirements

```
PHP ^5.6 || ^7.0
```

## Installation

```
composer require "midassoft/dominicanbankparser"
```

## Usage

Just select the parser you want to use and call the parse method with the file content.

```php
use MidasSoft\DominicanBankParser\Files\CSV;
use MidasSoft\DominicanBankParser\Parsers\BHDBankParser;

$parser = new BHDBankParser();
$file = file_get_contents(__DIR__.'/bhd_bank_file.csv');
$result = $parser->parse(new CSV($file));
```

You can especify a cache manager in your parser if you want your data to persist , every parse will be automatically cached.

```php
use MidasSoft\DominicanBankParser\Files\CSV;
use MidasSoft\DominicanBankParser\Parsers\BHDBankParser;

$parser = new BHDBankParser(new FileCacheDriver([
    'path' => __DIR__.'/cache',
    'timezone' => 'America/Santo_Domingo',
]));

$file = file_get_contents(__DIR__.'/bhd_bank_file.csv');
$result = $parser->parse(new CSV($file));
$cacheKeys = $parser->getCacheManager()->getKeys();
$parsedFromCache = $parser->getCacheManager()->get(end($cacheKeys));
```

There's two cache driver available `ArrayCacheDriver` and `FileCacheDriver`. When you use the `FileCacheDriver` you need to specify the `path` and `timezone` within your configuration.

## Supported banks

- BHD
- Popular
- Reservas
- Santa Cruz
