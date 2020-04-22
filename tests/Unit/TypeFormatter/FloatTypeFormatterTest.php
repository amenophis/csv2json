<?php

namespace Csv2Json\Tests\Unit\TypeFormatter;

use Csv2Json\Tests\TestCase;
use Csv2Json\TypeFormatter\FloatTypeFormatter;

return new class() extends TestCase {
    public function __invoke()
    {
        $this->testSupport();
        $this->testFormat();
    }

    private function testSupport()
    {
        $formatter = new FloatTypeFormatter();

        $this->assertTrue($formatter->supports('float', '1.0'));
        $this->assertTrue($formatter->supports('float', '1.1'));
        $this->assertTrue($formatter->supports('float', '1'));
        $this->assertTrue($formatter->supports('float', '0'));

        $this->assertFalse($formatter->supports('bad_type', 'true'));
        $this->assertFalse($formatter->supports('bad_type', 'false'));
        $this->assertFalse($formatter->supports('float', 'string'));
        $this->assertFalse($formatter->supports('float', 'true'));
        $this->assertFalse($formatter->supports('float', 'false'));
    }

    private function testFormat()
    {
        $formatter = new FloatTypeFormatter();

        $this->assertEquals(1.0, $formatter->format('1.0'));
        $this->assertEquals(1.1, $formatter->format('1.1'));
        $this->assertEquals(1.0, $formatter->format('1'));
        $this->assertEquals(0.0, $formatter->format('0'));
    }
};
