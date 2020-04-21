<?php

namespace Csv2Json\TypeFormatter;

class DatetimeTypeFormatter implements TypeFormatter
{
    public function supports(string $type, ?string $value): bool
    {
        return 'datetime' === $type && 1 === preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $value);
    }

    public function format(?string $value)
    {
        return $value;
    }
}
