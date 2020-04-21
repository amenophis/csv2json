<?php

namespace Csv2Json;

use Csv2Json\Aggregator\Aggregator;
use Csv2Json\Aggregator\Exception\InvalidFieldException;
use Csv2Json\CsvReader\CsvReader;
use Csv2Json\Formatter\DescriptionFile\DescriptionFile;
use Csv2Json\Formatter\Exception\FieldNotNullableException;
use Csv2Json\Formatter\Exception\NoMappingExistsForFieldException;
use Csv2Json\Formatter\Exception\UnformattableValueException;
use Csv2Json\Formatter\Formatter;
use Csv2Json\Formatter\Type\BooleanFormatterType;
use Csv2Json\Formatter\Type\DateFormatterType;
use Csv2Json\Formatter\Type\DatetimeFormatterType;
use Csv2Json\Formatter\Type\EmptyFormatterType;
use Csv2Json\Formatter\Type\FloatFormatterType;
use Csv2Json\Formatter\Type\IntegerFormatterType;
use Csv2Json\Formatter\Type\StringFormatterType;
use Csv2Json\Formatter\Type\TimeFormatterType;
use Csv2Json\JsonEncoder\Exception\UnableToEncodeJsonException;
use Csv2Json\JsonEncoder\JsonEncoder;

final class Application
{
    private CsvReader $reader;
    private Aggregator $aggregator;
    private JsonEncoder $encoder;
    private Formatter $formatter;

    public function __construct()
    {
        $this->reader = new CsvReader();
        $this->aggregator = new Aggregator();
        $this->encoder = new JsonEncoder();
        $this->formatter = new Formatter(...[
            new EmptyFormatterType(),
            new BooleanFormatterType(),
            new DatetimeFormatterType(),
            new DateFormatterType(),
            new FloatFormatterType(),
            new IntegerFormatterType(),
            new StringFormatterType(),
            new TimeFormatterType(),
        ]);
    }

    public function run(array $args): int
    {
        $arguments = Arguments::parse($args);
        if ($arguments->hasParsingErrors()) {
            echo 'Errors during arguments parsing :'.PHP_EOL;
            foreach ($arguments->getParsingErrors() as $error) {
                echo "  - {$error}".PHP_EOL;
            }
        }

        try {
            $fieldsDescription = DescriptionFile::parse($arguments->getDescriptionFilePath()); // TODO: Missing Exception

            $data = $this->reader->read($arguments->getCsvFilePath(), $arguments->getFields());
            $data = $this->formatter->format($fieldsDescription, $data);
            $data = $this->aggregator->aggregate($data, $arguments->getAggregate());
            echo $this->encoder->encode($data, $arguments->isPretty());
        } catch (
            FieldNotNullableException |
            UnformattableValueException |
            FieldNotNullableException |
            InvalidFieldException |
            UnableToEncodeJsonException |
            NoMappingExistsForFieldException $e
        ) {
            echo $e->getMessage();

            return 1;
        }

        return 0;
    }
}
