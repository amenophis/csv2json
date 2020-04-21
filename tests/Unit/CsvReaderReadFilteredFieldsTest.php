<?php

namespace Csv2Json\Tests\Unit\CsvReader;

use Csv2Json\CsvReader;
use Csv2Json\Tests\TestCase;

return new class() extends TestCase {
    public function __invoke()
    {
        $csvReader = new CsvReader();
        $data = $csvReader->read(self::FIXTURES_DIR.'/sample.csv', ['name']);

        $this->assertEquals([
            [
                'name' => 'a',
            ],
            [
                'name' => 'b',
            ],
            [
                'name' => 'c',
            ],
            [
                'name' => 'd',
            ],
            [
                'name' => 'e',
            ],
            [
                'name' => 'f',
            ],
            [
                'name' => 'g',
            ],
        ], $data);
    }
};
