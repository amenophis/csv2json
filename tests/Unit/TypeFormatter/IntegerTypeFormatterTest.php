<?php

namespace Csv2Json\Tests\Unit\TypeFormatter;

use Csv2Json\Tests\TestCase;
use Csv2Json\TypeFormatter\IntegerTypeFormatter;

return new class() extends TestCase {
    public function __invoke(): void
    {
        $this->testSupport();
        $this->testFormat();
    }

    private function testSupport(): void
    {
        $formatter = new IntegerTypeFormatter();

        $this->assertTrue($formatter->supports('int', '1'));
        $this->assertTrue($formatter->supports('integer', '1'));
        $this->assertTrue($formatter->supports('int', '0'));
        $this->assertTrue($formatter->supports('integer', '0'));

        $this->assertFalse($formatter->supports('bad_type', 'true'));
        $this->assertFalse($formatter->supports('bad_type', 'false'));
        $this->assertFalse($formatter->supports('int', 'true'));
        $this->assertFalse($formatter->supports('integer', 'true'));
        $this->assertFalse($formatter->supports('int', 'false'));
        $this->assertFalse($formatter->supports('integer', 'false'));
        $this->assertFalse($formatter->supports('int', 'string'));
        $this->assertFalse($formatter->supports('integer', 'string'));
        $this->assertFalse($formatter->supports('int', '1.1'));
        $this->assertFalse($formatter->supports('integer', '1.1'));
    }

    private function testFormat(): void
    {
        $formatter = new IntegerTypeFormatter();

        $this->assertEquals(1, $formatter->format('1'));
        $this->assertEquals(0, $formatter->format('0'));
    }
};
