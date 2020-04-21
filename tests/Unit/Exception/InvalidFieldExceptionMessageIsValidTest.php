<?php

namespace Csv2Json\Tests\Unit\Exception;

use Csv2Json\Exception\FieldNotNullableException;
use Csv2Json\Exception\InvalidFieldException;
use Csv2Json\Tests\TestCase;

(new class() extends TestCase {
    public function __invoke()
    {
        $e = InvalidFieldException::create($fieldName = 'field-name');

        $this->assertEquals(
            "The field {$fieldName} doesn't exists",
            $e->getMessage()
        );
    }
})();
