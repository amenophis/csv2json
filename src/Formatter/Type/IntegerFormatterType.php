<?php

namespace Csv2Json\Formatter\Type;

class IntegerFormatterType implements FormatterType
{
    public function supports(string $type, ?string $value): bool
    {
        return $type === 'integer' || $type === 'int';
    }

    public function format(?string $value)
    {
        return (int) $value;
    }
}