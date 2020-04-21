<?php

namespace Csv2Json\Tests\Unit\JsonEncoder;

use Csv2Json\DescriptionFile\DescriptionFile;
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

return new class() extends TestCase {
    public function __invoke()
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
};
