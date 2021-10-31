# csv2json

> :warning: **The repository is not maintained**: Use at your own risks !

A little tool to parse CSV file using type mapping and export to JSON 

## Installation
```bash
$ composer install --no-dev
```

## Usage
```bash
$ bin/csv2json ./fixtures/sample.csv --fields id,subid,name,date,time,datetime,length,valid,invalid --aggregate length --desc ./fixtures/description.txt --pretty
```

## Test
```bash
$ composer install --dev
$ bin/unit-test
```
