<?php

namespace Csv2Json\Tests\Unit\TypeFormatter;

use Csv2Json\Tests\TestCase;
use Csv2Json\TypeFormatter\DatetimeTypeFormatter;

return new class() extends TestCase {
    public function __invoke(): void
    {
        $this->testSupport();
        $this->testFormat();
    }

    private function testSupport(): void
    {
        $formatter = new DatetimeTypeFormatter();

        $this->assertTrue($formatter->supports('datetime', '2020-03-15 15:12:17'));
        $this->assertFalse($formatter->supports('datetime', 'false'));
        $this->assertFalse($formatter->supports('datetime', '1'));
        $this->assertFalse($formatter->supports('datetime', '0'));
        $this->assertFalse($formatter->supports('datetime', 'bonjour'));
    }

    private function testFormat(): void
    {
        $formatter = new DatetimeTypeFormatter();

        $this->assertEquals('2020-03-15 15:12:17', $formatter->format('2020-03-15 15:12:17'));
        $this->assertEquals('2021-04-16 16:13:18', $formatter->format('2021-04-16 16:13:18'));
    }
};
