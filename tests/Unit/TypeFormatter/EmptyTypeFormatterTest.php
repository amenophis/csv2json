<?php

namespace Csv2Json\Tests\Unit\TypeFormatter;

use Csv2Json\Tests\TestCase;
use Csv2Json\TypeFormatter\EmptyTypeFormatter;

return new class() extends TestCase {
    public function __invoke(): void
    {
        $this->testSupport();
        $this->testFormat();
    }

    private function testSupport(): void
    {
        $formatter = new EmptyTypeFormatter();

        $this->assertTrue($formatter->supports('random_type', ''));
        $this->assertTrue($formatter->supports('other_type', ''));

        $this->assertFalse($formatter->supports('random_type', 'true'));
        $this->assertFalse($formatter->supports('other_type', 'false'));
    }

    private function testFormat(): void
    {
        $formatter = new EmptyTypeFormatter();

        $this->assertNull($formatter->format(''));
    }
};
