<?php

namespace Csv2Json\Tests\Unit\Exception;

use Csv2Json\Exception\FieldNotNullableException;
use Csv2Json\Exception\NoMappingExistsForFieldException;
use Csv2Json\Exception\UnableToEncodeJsonException;
use Csv2Json\Exception\UnformatableValueException;
use Csv2Json\Tests\TestCase;

return new class() extends TestCase {
    public function __invoke()
    {
        $e = UnformatableValueException::create();

        $this->assertEquals(
            'Unformatable value',
            $e->getMessage()
        );
    }
};
