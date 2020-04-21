<?php

namespace Csv2Json\Tests\Unit\Formatter\DescriptionFile;

use Csv2Json\DescriptionFile\DescriptionFile;
use Csv2Json\Exception\FileCannotBeOpenedException;
use Csv2Json\Tests\TestCase;

(new class() extends TestCase {
    public function __invoke()
    {
        $description = DescriptionFile::parse(self::FIXTURES_DIR.'/description.txt');

        $idType = $description->getType('id');
        $this->assertEquals('id', $idType->getField());
        $this->assertEquals('int', $idType->getType());
        $this->assertEquals(true, $idType->isNullable());

        $subidType = $description->getType('subid');
        $this->assertEquals('subid', $subidType->getField());
        $this->assertEquals('integer', $subidType->getType());
        $this->assertEquals(false, $subidType->isNullable());

        $nameType = $description->getType('name');
        $this->assertEquals('name', $nameType->getField());
        $this->assertEquals('string', $nameType->getType());
        $this->assertEquals(false, $nameType->isNullable());

        $dateType = $description->getType('date');
        $this->assertEquals('date', $dateType->getField());
        $this->assertEquals('date', $dateType->getType());
        $this->assertEquals(false, $dateType->isNullable());

        $timeType = $description->getType('time');
        $this->assertEquals('time', $timeType->getField());
        $this->assertEquals('time', $timeType->getType());
        $this->assertEquals(false, $timeType->isNullable());

        $datetimeType = $description->getType('datetime');
        $this->assertEquals('datetime', $datetimeType->getField());
        $this->assertEquals('datetime', $datetimeType->getType());
        $this->assertEquals(false, $datetimeType->isNullable());

        $lengthType = $description->getType('length');
        $this->assertEquals('length', $lengthType->getField());
        $this->assertEquals('float', $lengthType->getType());
        $this->assertEquals(false, $lengthType->isNullable());

        $validType = $description->getType('valid');
        $this->assertEquals('valid', $validType->getField());
        $this->assertEquals('bool', $validType->getType());
        $this->assertEquals(false, $validType->isNullable());

        $invalidType = $description->getType('invalid');
        $this->assertEquals('invalid', $invalidType->getField());
        $this->assertEquals('boolean', $invalidType->getType());
        $this->assertEquals(false, $invalidType->isNullable());
    }
})();
