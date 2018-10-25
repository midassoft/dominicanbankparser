# About Dominican Bank Parser

This package allows you to parse files from the major dominican Bank entities.

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/midassoft/dominicanbankparser/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/midassoft/dominicanbankparser/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/midassoft/dominicanbankparser/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/midassoft/dominicanbankparser/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/midassoft/dominicanbankparser/badges/build.png?b=master)](https://scrutinizer-ci.com/g/midassoft/dominicanbankparser/build-status/master)
[![Build Status](https://travis-ci.org/midassoft/dominicanbankparser.svg?branch=master)](https://travis-ci.org/midassoft/dominicanbankparser)
[![StyleCI](https://github.styleci.io/repos/150613956/shield?branch=master)](https://github.styleci.io/repos/150613956)

## Requirements

```
PHP ^7.1.3
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

This will return a [collection](https://laravel.com/docs/5.7/collections) of `Deposit` objects.

```
object(MidasSoft\DominicanBankParser\Collections\DepositCollection)#302 (1) {
  ["items":protected]=>
  array(91) {
    [0]=>
    object(MidasSoft\DominicanBankParser\Deposit)#23 (4) {
      ["amount":"MidasSoft\DominicanBankParser\Deposit":private]=>
      string(7) "4000.00"
      ["date":"MidasSoft\DominicanBankParser\Deposit":private]=>
      string(10) "19/12/2017"
      ["description":"MidasSoft\DominicanBankParser\Deposit":private]=>
      string(15) "DEPOSITO:3228-4"
      ["term":"MidasSoft\DominicanBankParser\Deposit":private]=>
      string(15) "DEPOSITO:3228-4"
    }
    [1]=>
    object(MidasSoft\DominicanBankParser\Deposit)#24 (4) {
      ["amount":"MidasSoft\DominicanBankParser\Deposit":private]=>
      string(8) "11805.00"
      ["date":"MidasSoft\DominicanBankParser\Deposit":private]=>
      string(10) "19/12/2017"
      ["description":"MidasSoft\DominicanBankParser\Deposit":private]=>
      string(19) "DEPOSITO:6051-7/195"
      ["term":"MidasSoft\DominicanBankParser\Deposit":private]=>
      string(19) "DEPOSITO:6051-7/195"
    }
  }
}
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

Also you can write your own parsers by extending the `MidasSoft\DominicanBankParser\Parsers\AbstractParser` class, and your own cache drivers by extending `MidasSoft\DominicanBankParser\Cache\AbstractCacheDriver`.

## Supported banks

- BHD
- Popular
- Reservas
- Santa Cruz
