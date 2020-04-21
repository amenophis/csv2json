<?php

namespace Csv2Json\Formatter\Type;

class IntegerFormatterType implements FormatterType
{
    public function supports(string $type, ?string $value): bool
    {
        return 'integer' === $type || 'int' === $type;
    }

    public function format(?string $value)
    {
        return (int) $value;
    }
}
