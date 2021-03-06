<?php

namespace Csv2Json\Tests\Unit\Exception;

use Csv2Json\Exception\UnformatableValueException;
use Csv2Json\Tests\TestCase;

return new class() extends TestCase {
    public function __invoke(): void
    {
        $this->testMessageIsValid();
    }

    private function testMessageIsValid(): void
    {
        $e = UnformatableValueException::create();

        $this->assertEquals(
            'Unformatable value',
            $e->getMessage()
        );
    }
};
