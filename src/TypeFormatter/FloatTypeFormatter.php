<?php

namespace Csv2Json\TypeFormatter;

class FloatTypeFormatter implements TypeFormatter
{
    public function supports(string $type, ?string $value): bool
    {
        return 'float' === $type && null !== filter_var($value, FILTER_VALIDATE_FLOAT | FILTER_NULL_ON_FAILURE);
    }

    public function format(?string $value)
    {
        return filter_var($value, FILTER_VALIDATE_FLOAT);
    }
}
