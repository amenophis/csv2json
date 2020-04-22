<?php

namespace Csv2Json\Tests\Unit\Exception;

use Csv2Json\Exception\UnableToEncodeJsonException;
use Csv2Json\Tests\TestCase;

return new class() extends TestCase {
    public function __invoke()
    {
        $this->testMessageIsValid();
    }

    private function testMessageIsValid()
    {
        $e = UnableToEncodeJsonException::create($error = 'json encode error');

        $this->assertEquals(
            $error,
            $e->getMessage()
        );
    }
};
