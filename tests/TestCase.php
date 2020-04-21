<?php

namespace Csv2Json\Tests;

abstract class TestCase
{
    const FIXTURES_DIR = __DIR__.'/../fixtures';

    protected function assertTrue($value)
    {
        if (true !== $value) {
            throw new AssertException('The value must be true');
        }
    }

    protected function assertEquals($expected, $value)
    {
        if ($expected !== $value) {
            throw new AssertException('The values must be equals');
        }
    }

    protected function expectException(string $className, callable $function)
    {
        try {
            $function();
        } catch (\Throwable $t) {
            if (\get_class($t) === $className) {
                return;
            }
        }

        throw new AssertException("Expected expection {$className} not thrown");
    }
}
