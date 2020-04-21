<?php

namespace Csv2Json\Tests\Unit\Formatter\DescriptionFile;

use Csv2Json\DescriptionFile\DescriptionFile;
use Csv2Json\Exception\NoMappingExistsForFieldException;
use Csv2Json\Tests\TestCase;

return new class() extends TestCase {
    public function __invoke()
    {
        $description = DescriptionFile::parse(self::FIXTURES_DIR.'/description.txt');
        $this->expectException(NoMappingExistsForFieldException::class, function () use ($description) {
            $description->getType('phantom');
        });
    }
};
