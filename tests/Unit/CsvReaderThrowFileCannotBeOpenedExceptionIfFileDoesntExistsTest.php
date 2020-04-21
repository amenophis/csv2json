<?php

namespace Csv2Json\Tests\Unit\CsvReader;

use Csv2Json\CsvReader;
use Csv2Json\Exception\FileCannotBeOpenedException;
use Csv2Json\Tests\TestCase;

(new class() extends TestCase {
    public function __invoke()
    {
        $csvReader = new CsvReader();
        $this->expectException(FileCannotBeOpenedException::class, function () use ($csvReader) {
            $csvReader->read(self::FIXTURES_DIR, []);
        });
    }
})();
