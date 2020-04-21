<?php

namespace Csv2Json\Formatter\Type;

class EmptyFormatterType implements FormatterType
{
    public function supports(string $type, ?string $value): bool
    {
        return '' === $value;
    }

    public function format(?string $value)
    {
        return null;
    }
}
