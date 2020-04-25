<?php

namespace Csv2Json\Tests\Unit;

use Csv2Json\DescriptionFile\DescriptionFile;
use Csv2Json\Exception\FieldNotNullableException;
use Csv2Json\Exception\UnformatableValueException;
use Csv2Json\Formatter;
use Csv2Json\Tests\TestCase;
use Csv2Json\TypeFormatter\BooleanTypeFormatter;
use Csv2Json\TypeFormatter\DatetimeTypeFormatter;
use Csv2Json\TypeFormatter\DateTypeFormatter;
use Csv2Json\TypeFormatter\EmptyTypeFormatter;
use Csv2Json\TypeFormatter\FloatTypeFormatter;
use Csv2Json\TypeFormatter\IntegerTypeFormatter;
use Csv2Json\TypeFormatter\StringTypeFormatter;
use Csv2Json\TypeFormatter\TimeTypeFormatter;

return new class() extends TestCase{
    public function __invoke(): void
    {
        $this->testFormatRecursiveData();
        $this->testThrowExceptionIfEmptyValueForNotNullableField();
        $this->testThrowExceptionIfNoFormatterExistsForType();
    }

    private function testFormatRecursiveData(): void
    {
        $descriptionFile = DescriptionFile::parse(self::FIXTURES_DIR.'/description.txt');

        $data = [
            [
                'id' => '1',
                'sub' => [
                    'id' => '1',
                    'sub' => [
                        'id' => '1',
                    ],
                ],
            ],
        ];

        $formatter = new Formatter(...[
            new EmptyTypeFormatter(),
            new BooleanTypeFormatter(),
            new DatetimeTypeFormatter(),
            new DateTypeFormatter(),
            new FloatTypeFormatter(),
            new IntegerTypeFormatter(),
            new StringTypeFormatter(),
            new TimeTypeFormatter(),
        ]);
        $formattedData = $formatter->format($descriptionFile, $data);

        $this->assertEquals(
            [
                [
                    'id' => 1,
                    'sub' => [
                        'id' => 1,
                        'sub' => [
                            'id' => 1,
                        ],
                    ],
                ],
            ],
            $formattedData
        );
    }

    private function testThrowExceptionIfEmptyValueForNotNullableField(): void
    {
        $descriptionFile = DescriptionFile::parse(self::FIXTURES_DIR.'/description.txt');

        $data = [
            [
                'id' => '1',
                'name' => '',
                'date' => '2020-05-07',
            ],
        ];

        $formatter = new Formatter(...[
            new EmptyTypeFormatter(),
            new BooleanTypeFormatter(),
            new DatetimeTypeFormatter(),
            new DateTypeFormatter(),
            new FloatTypeFormatter(),
            new IntegerTypeFormatter(),
            new StringTypeFormatter(),
            new TimeTypeFormatter(),
        ]);

        $this->expectException(FieldNotNullableException::class, function () use ($formatter, $descriptionFile, $data) {
            $formatter->format($descriptionFile, $data);
        });
    }

    private function testThrowExceptionIfNoFormatterExistsForType(): void
    {
        $descriptionFile = DescriptionFile::parse(self::FIXTURES_DIR.'/description.txt');

        $data = [
            [
                'id' => '1',
            ],
        ];

        $formatter = new Formatter();
        $this->expectException(UnformatableValueException::class, function () use ($formatter, $descriptionFile, $data) {
            $formatter->format($descriptionFile, $data);
        });
    }
};
