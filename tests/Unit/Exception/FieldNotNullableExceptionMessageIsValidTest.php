<?php

namespace Csv2Json\Tests\Unit\Exception;

use Csv2Json\Exception\FieldNotNullableException;
use Csv2Json\Tests\TestCase;

(new class() extends TestCase {
    public function __invoke()
    {
        $e = FieldNotNullableException::create();

        $this->assertEquals(
            'Not nullable field',
            $e->getMessage()
        );
    }
})();
