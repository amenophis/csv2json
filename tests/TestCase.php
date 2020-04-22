<?php

namespace Csv2Json\Tests;

abstract class TestCase
{
    const FIXTURES_DIR = __DIR__.'/../fixtures';

    /**
     * @throws AssertException
     */
    abstract public function __invoke();

    protected function assertEquals($expected, $value)
    {
        if ($expected !== $value) {
            throw new AssertException('The value must be equals');
        }
    }

    protected function assertNull($value)
    {
        if (null !== $value) {
            throw new AssertException('The value must be true');
        }
    }

    protected function assertTrue($value)
    {
        if (true !== $value) {
            throw new AssertException('The value must be true');
        }
    }

    protected function assertFalse($value)
    {
        if (false !== $value) {
            throw new AssertException('The value must be false');
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
