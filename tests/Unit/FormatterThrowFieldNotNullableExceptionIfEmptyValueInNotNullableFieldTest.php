<?php

namespace Csv2Json\Tests\Unit\JsonEncoder;

use Csv2Json\DescriptionFile\DescriptionFile;
use Csv2Json\Exception\FieldNotNullableException;
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

(new class() extends TestCase {
    public function __invoke()
    {
        $descriptionFile = DescriptionFile::parse(self::FIXTURES_DIR.'/description.txt');

        $data = [
            [
                'id' => '1',
                'name' => '',
                'date' => '2020-05-07'
            ]
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

        $this->expectException(FieldNotNullableException::class, function () use ($formatter, $descriptionFile, $data){
            $formatter->format($descriptionFile, $data);
        });
    }
})();
