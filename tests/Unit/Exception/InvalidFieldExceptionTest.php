<?php

namespace Csv2Json\Tests\Unit\Exception;

use Csv2Json\Exception\InvalidFieldException;
use Csv2Json\Tests\TestCase;

return new class() extends TestCase {
    public function __invoke()
    {
        $this->testMessageIsValid();
    }

    private function testMessageIsValid()
    {
        $e = InvalidFieldException::create($fieldName = 'field-name');

        $this->assertEquals(
            "The field {$fieldName} doesn't exists",
            $e->getMessage()
        );
    }
};
