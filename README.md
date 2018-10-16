# About Dominican Bank Parser

This package allows you to parse files from the major dominican bank companies.

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
use namespace MidasSoft\DominicanBankParser\Parsers\BHDBankParser;

$parser = new BHDBankParser();
$result = $parser->parse(file_get_contents(__DIR__.'/bhd_bank_file.csv'));
```

## Supported banks

- Banco BHD Leon
- Banco Popular Dominicano
- Banco de Reservas
- Banco Santa Cruz