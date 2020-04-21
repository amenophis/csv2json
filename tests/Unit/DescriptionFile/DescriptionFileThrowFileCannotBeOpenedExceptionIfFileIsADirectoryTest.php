<?php

namespace Csv2Json\Tests\Unit\Formatter\DescriptionFile;

use Csv2Json\DescriptionFile\DescriptionFile;
use Csv2Json\Exception\FileCannotBeOpenedException;
use Csv2Json\Tests\TestCase;

(new class() extends TestCase {
    public function __invoke()
    {
        $this->expectException(FileCannotBeOpenedException::class, function () {
            DescriptionFile::parse(self::FIXTURES_DIR);
        });
    }
})();
