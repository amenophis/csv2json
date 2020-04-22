<?php

namespace Csv2Json\Tests\Unit\TypeFormatter;

use Csv2Json\Tests\TestCase;
use Csv2Json\TypeFormatter\StringTypeFormatter;

return new class() extends TestCase {
    public function __invoke()
    {
        $this->testSupport();
        $this->testFormat();
    }

    private function testSupport()
    {
        $formatter = new StringTypeFormatter();

        $this->assertTrue($formatter->supports('string', 'foo'));
        $this->assertTrue($formatter->supports('string', 'bar'));
        $this->assertTrue($formatter->supports('string', '123'));
        $this->assertTrue($formatter->supports('string', 'true'));
        $this->assertTrue($formatter->supports('string', 'false'));

        $this->assertFalse($formatter->supports('bad_type', 'true'));
        $this->assertFalse($formatter->supports('bad_type', 'false'));
        $this->assertFalse($formatter->supports('int', 'true'));
        $this->assertFalse($formatter->supports('integer', 'true'));
        $this->assertFalse($formatter->supports('int', 'false'));
        $this->assertFalse($formatter->supports('integer', 'false'));
        $this->assertFalse($formatter->supports('int', 'foo'));
        $this->assertFalse($formatter->supports('integer', 'foo'));
        $this->assertFalse($formatter->supports('int', '1.1'));
        $this->assertFalse($formatter->supports('integer', '1.1'));
    }

    private function testFormat()
    {
        $formatter = new StringTypeFormatter();

        $this->assertEquals('foo', $formatter->format('foo'));
        $this->assertEquals('bar', $formatter->format('bar'));
        $this->assertEquals('', $formatter->format(null));
    }
};
