<?php

namespace Csv2Json;

use Csv2Json\Aggregator;
use Csv2Json\Exception\InvalidFieldException;
use Csv2Json\CsvReader;
use Csv2Json\Exception\FileCannotBeOpenedException;
use Csv2Json\DescriptionFile\DescriptionFile;
use Csv2Json\Exception\FieldNotNullableException;
use Csv2Json\Exception\NoMappingExistsForFieldException;
use Csv2Json\Exception\UnformatableValueException;
use Csv2Json\Formatter;
use Csv2Json\TypeFormatter\BooleanTypeFormatter;
use Csv2Json\TypeFormatter\DatetimeTypeFormatter;
use Csv2Json\TypeFormatter\DateTypeFormatter;
use Csv2Json\TypeFormatter\EmptyTypeFormatter;
use Csv2Json\TypeFormatter\FloatTypeFormatter;
use Csv2Json\TypeFormatter\IntegerTypeFormatter;
use Csv2Json\TypeFormatter\StringTypeFormatter;
use Csv2Json\TypeFormatter\TimeTypeFormatter;
use Csv2Json\Exception\UnableToEncodeJsonException;
use Csv2Json\JsonEncoder;

final class Application
{
    private CsvReader $csvReader;
    private Aggregator $aggregator;
    private JsonEncoder $jsonEncoder;
    private Formatter $formatter;

    public function __construct()
    {
        $this->csvReader = new CsvReader();
        $this->aggregator = new Aggregator();
        $this->jsonEncoder = new JsonEncoder();
        $this->formatter = new Formatter(...[
            new EmptyTypeFormatter(),
            new BooleanTypeFormatter(),
            new DatetimeTypeFormatter(),
            new DateTypeFormatter(),
            new FloatTypeFormatter(),
            new IntegerTypeFormatter(),
            new StringTypeFormatter(),
            new TimeTypeFormatter(),
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

            $data = $this->csvReader->read($arguments->getCsvFilePath(), $arguments->getFields());
            $data = $this->formatter->format($fieldsDescription, $data);
            if (null !== $arguments->getAggregate()) {
                $data = $this->aggregator->aggregate($data, $arguments->getAggregate());
            }
            echo $this->jsonEncoder->encode($data, $arguments->isPretty());
        } catch (
            FileCannotBeOpenedException |
            FieldNotNullableException |
            UnformatableValueException |
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
