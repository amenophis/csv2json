<?php

namespace Csv2Json\Tests\Unit\JsonEncoder;

use Csv2Json\DescriptionFile\DescriptionFile;
use Csv2Json\Exception\UnformatableValueException;
use Csv2Json\Formatter;
use Csv2Json\Tests\TestCase;

return new class() extends TestCase {
    public function __invoke()
    {
        $descriptionFile = DescriptionFile::parse(self::FIXTURES_DIR.'/description.txt');

        $data = [
            [
                'id' => '1'
            ]
        ];

        $formatter = new Formatter();
        $this->expectException(UnformatableValueException::class, function () use ($formatter, $descriptionFile, $data){
            $formatter->format($descriptionFile, $data);
        });
    }
};
