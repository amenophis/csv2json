<?php

namespace Csv2Json\Tests\Unit\Exception;

use Csv2Json\Exception\FileCannotBeOpenedException;
use Csv2Json\Tests\TestCase;

return new class() extends TestCase {
    public function __invoke(): void
    {
        $this->testMessageIsValid();
    }

    private function testMessageIsValid(): void
    {
        $e = FileCannotBeOpenedException::create($fileName = 'file-name');

        $this->assertEquals(
            "The file {$fileName} can't be opened",
            $e->getMessage()
        );
    }
};
