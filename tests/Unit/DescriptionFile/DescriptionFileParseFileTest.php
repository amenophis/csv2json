<?php

namespace Csv2Json\Tests\Unit\Formatter\DescriptionFile;

use Csv2Json\DescriptionFile\DescriptionFile;
use Csv2Json\Tests\TestCase;

return new class() extends TestCase {
    public function __invoke()
    {
        $description = DescriptionFile::parse(self::FIXTURES_DIR.'/description.txt');

        $idType = $description->getType('id');
        $this->assertEquals('id', $idType->getField());
        $this->assertEquals('int', $idType->getType());
        $this->assertTrue($idType->isNullable());

        $subidType = $description->getType('subid');
        $this->assertEquals('subid', $subidType->getField());
        $this->assertEquals('integer', $subidType->getType());
        $this->assertFalse($subidType->isNullable());

        $nameType = $description->getType('name');
        $this->assertEquals('name', $nameType->getField());
        $this->assertEquals('string', $nameType->getType());
        $this->assertFalse($nameType->isNullable());

        $dateType = $description->getType('date');
        $this->assertEquals('date', $dateType->getField());
        $this->assertEquals('date', $dateType->getType());
        $this->assertFalse($dateType->isNullable());

        $timeType = $description->getType('time');
        $this->assertEquals('time', $timeType->getField());
        $this->assertEquals('time', $timeType->getType());
        $this->assertFalse($timeType->isNullable());

        $datetimeType = $description->getType('datetime');
        $this->assertEquals('datetime', $datetimeType->getField());
        $this->assertEquals('datetime', $datetimeType->getType());
        $this->assertFalse($datetimeType->isNullable());

        $lengthType = $description->getType('length');
        $this->assertEquals('length', $lengthType->getField());
        $this->assertEquals('float', $lengthType->getType());
        $this->assertFalse($lengthType->isNullable());

        $validType = $description->getType('valid');
        $this->assertEquals('valid', $validType->getField());
        $this->assertEquals('bool', $validType->getType());
        $this->assertFalse($validType->isNullable());

        $invalidType = $description->getType('invalid');
        $this->assertEquals('invalid', $invalidType->getField());
        $this->assertEquals('boolean', $invalidType->getType());
        $this->assertFalse($invalidType->isNullable());
    }
};
