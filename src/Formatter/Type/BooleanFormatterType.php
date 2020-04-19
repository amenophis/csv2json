<?php

namespace Csv2Json\Formatter\Type;

class BooleanFormatterType implements FormatterType
{
    public function supports(string $type, ?string $value): bool
    {
        return
            ($type === 'boolean' || $type === 'bool')
            && null !== filter_var($value, FILTER_VALIDATE_BOOLEAN|FILTER_NULL_ON_FAILURE)
        ;
    }

    public function format(?string $value)
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}