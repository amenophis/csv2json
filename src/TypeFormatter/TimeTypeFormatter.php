<?php

namespace Csv2Json\TypeFormatter;

class TimeTypeFormatter implements TypeFormatter
{
    public function supports(string $type, ?string $value): bool
    {
        return 'time' === $type && 1 === preg_match('/^\d{2}:\d{2}:\d{2}$/', $value);
    }

    public function format(?string $value)
    {
        return $value;
    }
}
