<?php

namespace Csv2Json\TypeFormatter;

class BooleanTypeFormatter implements TypeFormatter
{
    public function supports(string $type, ?string $value): bool
    {
        return
            ('boolean' === $type || 'bool' === $type)
            && null !== filter_var($value, FILTER_VALIDATE_BOOLEAN | FILTER_NULL_ON_FAILURE)
        ;
    }

    public function format(?string $value)
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}
