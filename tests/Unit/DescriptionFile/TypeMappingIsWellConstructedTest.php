<?php

namespace Csv2Json\Tests\Unit\Formatter\DescriptionFile;

use Csv2Json\DescriptionFile\TypeMapping;
use Csv2Json\Tests\TestCase;

return new class() extends TestCase {
    public function __invoke()
    {
        $typeMapping = new TypeMapping(
            $field = 'id',
            $type = 'bool',
            $nullable = false
        );
        $this->assertEquals($field, $typeMapping->getField());
        $this->assertEquals($type, $typeMapping->getType());
        $this->assertEquals($nullable, $typeMapping->isNullable());

        $typeMapping = new TypeMapping(
            $field = 'name',
            $type = 'int',
            $nullable = true
        );
        $this->assertEquals($field, $typeMapping->getField());
        $this->assertEquals($type, $typeMapping->getType());
        $this->assertEquals($nullable, $typeMapping->isNullable());
    }
};
