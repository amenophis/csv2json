<?php

namespace Csv2Json\Tests\Unit\TypeFormatter;

use Csv2Json\Tests\TestCase;
use Csv2Json\TypeFormatter\BooleanTypeFormatter;

return new class() extends TestCase {
    public function __invoke(): void
    {
        $this->testSupport();
        $this->testFormat();
    }

    private function testSupport(): void
    {
        $formatter = new BooleanTypeFormatter();

        $this->assertTrue($formatter->supports('bool', 'true'));
        $this->assertTrue($formatter->supports('boolean', 'true'));
        $this->assertTrue($formatter->supports('bool', 'false'));
        $this->assertTrue($formatter->supports('boolean', 'false'));
        $this->assertTrue($formatter->supports('bool', '1'));
        $this->assertTrue($formatter->supports('boolean', '1'));
        $this->assertTrue($formatter->supports('bool', '0'));
        $this->assertTrue($formatter->supports('boolean', '0'));

        $this->assertFalse($formatter->supports('bad_type', 'true'));
        $this->assertFalse($formatter->supports('bad_type', 'false'));
        $this->assertFalse($formatter->supports('bool', 'string'));
        $this->assertFalse($formatter->supports('boolean', 'string'));
        $this->assertFalse($formatter->supports('bool', '1.1'));
        $this->assertFalse($formatter->supports('boolean', '1.1'));
    }

    private function testFormat(): void
    {
        $formatter = new BooleanTypeFormatter();

        $this->assertTrue($formatter->format('true'));
        $this->assertTrue($formatter->format('true'));
        $this->assertFalse($formatter->format('false'));
        $this->assertFalse($formatter->format('false'));
        $this->assertTrue($formatter->format('1'));
        $this->assertTrue($formatter->format('1'));
        $this->assertFalse($formatter->format('0'));
        $this->assertFalse($formatter->format('0'));
    }
};
