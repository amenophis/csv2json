<?php

namespace Csv2Json\Formatter\Type;

class StringFormatterType implements FormatterType
{
    public function supports(string $type, ?string $value): bool
    {
        return 'string' === $type;
    }

    public function format(?string $value)
    {
        return $value;
    }
}
