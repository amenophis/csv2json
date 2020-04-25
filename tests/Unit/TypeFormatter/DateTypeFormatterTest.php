<?php

namespace Csv2Json\Tests\Unit\TypeFormatter;

use Csv2Json\Tests\TestCase;
use Csv2Json\TypeFormatter\DateTypeFormatter;

return new class() extends TestCase {
    public function __invoke(): void
    {
        $this->testSupport();
        $this->testFormat();
    }

    private function testSupport(): void
    {
        $formatter = new DateTypeFormatter();

        $this->assertTrue($formatter->supports('date', '2020-03-15'));
        $this->assertFalse($formatter->supports('date', 'false'));
        $this->assertFalse($formatter->supports('date', '1'));
        $this->assertFalse($formatter->supports('date', '0'));
        $this->assertFalse($formatter->supports('date', 'bonjour'));
    }

    private function testFormat(): void
    {
        $formatter = new DateTypeFormatter();

        $this->assertEquals('2020-03-15', $formatter->format('2020-03-15'));
        $this->assertEquals('2021-04-16', $formatter->format('2021-04-16'));
    }
};
