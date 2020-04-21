<?php

namespace Csv2Json\Tests;

abstract class TestCase
{
    protected function assertTrue($value)
    {
        if ($value !== true) {
            throw new AssertException('The value must be true');
        }
    }

    protected function assertEquals($expected, $value)
    {
        if ($expected !== $value) {
            throw new AssertException('The values must be equals');
        }
    }
}