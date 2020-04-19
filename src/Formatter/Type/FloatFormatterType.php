<?php

namespace Csv2Json\Formatter\Type;

class FloatFormatterType implements FormatterType
{
    public function supports(string $type, ?string $value): bool
    {
        return $type === 'float' && null !== filter_var($value, FILTER_VALIDATE_FLOAT|FILTER_NULL_ON_FAILURE);
    }

    public function format(?string $value)
    {
        return filter_var($value, FILTER_VALIDATE_FLOAT);
    }
}