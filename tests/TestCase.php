<?php

namespace Csv2Json\Tests;

abstract class TestCase
{
    const FIXTURES_DIR = __DIR__.'/../fixtures';

    /**
     * @throws AssertException
     */
    abstract public function __invoke();

    protected function assertEquals($expected, $value): void
    {
        if ($expected !== $value) {
            throw new AssertException('The value must be equals');
        }
    }

    protected function assertNull($value): void
    {
        if (null !== $value) {
            throw new AssertException('The value must be true');
        }
    }

    protected function assertTrue($value): void
    {
        if (true !== $value) {
            throw new AssertException('The value must be true');
        }
    }

    protected function assertFalse($value): void
    {
        if (false !== $value) {
            throw new AssertException('The value must be false');
        }
    }

    protected function expectException(string $className, callable $function): void
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
