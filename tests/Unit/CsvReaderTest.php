<?php

namespace Csv2Json\Tests\Unit;

use Csv2Json\CsvReader;
use Csv2Json\Exception\FileCannotBeOpenedException;
use Csv2Json\Tests\TestCase;

return new class() extends TestCase {
    public function __invoke()
    {
        $this->testReadAllFields();
        $this->testReadFilteredFields();
        $this->testThrowExceptionIfFileDoesntExists();
        $this->testThrowExceptionIfFileIsADirectory();
    }

    private function testReadAllFields()
    {
        $csvReader = new CsvReader();
        $data = $csvReader->read(self::FIXTURES_DIR.'/sample.csv', ['name', 'id', 'date']);

        $this->assertEquals([
            [
                'id' => '5',
                'name' => 'a',
                'date' => '2020-05-03',
            ],
            [
                'id' => '',
                'name' => 'b',
                'date' => '2020-05-03',
            ],
            [
                'id' => '1',
                'name' => 'c',
                'date' => '2020-03-21',
            ],
            [
                'id' => '4',
                'name' => 'd',
                'date' => '2020-03-14',
            ],
            [
                'id' => '',
                'name' => 'e',
                'date' => '2020-05-07',
            ],
            [
                'id' => '5',
                'name' => 'f',
                'date' => '2020-02-19',
            ],
            [
                'id' => '10',
                'name' => 'g',
                'date' => '2020-04-30',
            ],
        ], $data);
    }

    private function testReadFilteredFields()
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

    private function testThrowExceptionIfFileDoesntExists()
    {
        $csvReader = new CsvReader();
        $this->expectException(FileCannotBeOpenedException::class, function () use ($csvReader) {
            $csvReader->read(self::FIXTURES_DIR, []);
        });
    }

    private function testThrowExceptionIfFileIsADirectory()
    {
        $csvReader = new CsvReader();
        $this->expectException(FileCannotBeOpenedException::class, function () use ($csvReader) {
            $csvReader->read(self::FIXTURES_DIR.'/phantom.csv', []);
        });
    }
};
