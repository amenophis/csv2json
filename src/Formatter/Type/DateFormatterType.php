<?php

namespace Csv2Json\Formatter\Type;

class DateFormatterType implements FormatterType
{
    public function supports(string $type, ?string $value): bool
    {
        return 'date' === $type && 1 === preg_match('/^\d{4}-\d{2}-\d{2}$/', $value);
    }

    public function format(?string $value)
    {
        return $value;
    }
}
