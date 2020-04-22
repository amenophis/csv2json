<?php

namespace Csv2Json\Tests\Unit\TypeFormatter;

use Csv2Json\Tests\TestCase;
use Csv2Json\TypeFormatter\TimeTypeFormatter;

return new class() extends TestCase {
    public function __invoke()
    {
        $this->testSupport();
        $this->testFormat();
    }

    private function testSupport()
    {
        $formatter = new TimeTypeFormatter();

        $this->assertTrue($formatter->supports('time', '15:12:17'));
        $this->assertFalse($formatter->supports('time', 'false'));
        $this->assertFalse($formatter->supports('time', '1'));
        $this->assertFalse($formatter->supports('time', '0'));
        $this->assertFalse($formatter->supports('time', 'bonjour'));
    }

    private function testFormat()
    {
        $formatter = new TimeTypeFormatter();

        $this->assertEquals('15:12:17', $formatter->format('15:12:17'));
        $this->assertEquals('16:13:18', $formatter->format('16:13:18'));
    }
};
