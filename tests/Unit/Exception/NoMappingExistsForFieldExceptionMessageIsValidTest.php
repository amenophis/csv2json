<?php

namespace Csv2Json\Tests\Unit\Exception;

use Csv2Json\Exception\FieldNotNullableException;
use Csv2Json\Exception\NoMappingExistsForFieldException;
use Csv2Json\Tests\TestCase;

(new class() extends TestCase {
    public function __invoke()
    {
        $e = NoMappingExistsForFieldException::create($fieldName = 'field-name');

        $this->assertEquals(
            "No mapping exists for {$fieldName} field",
            $e->getMessage()
        );
    }
})();
