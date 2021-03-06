<?php

namespace Csv2Json\Tests\Unit\Exception;

use Csv2Json\Exception\FieldNotNullableException;
use Csv2Json\Tests\TestCase;

return new class() extends TestCase {
    public function __invoke(): void
    {
        $this->testMessageIsValid();
    }

    private function testMessageIsValid(): void
    {
        $e = FieldNotNullableException::create();

        $this->assertEquals(
            'Not nullable field',
            $e->getMessage()
        );
    }
};
