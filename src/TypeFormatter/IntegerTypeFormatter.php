<?php

namespace Csv2Json\TypeFormatter;

class IntegerTypeFormatter implements TypeFormatter
{
    public function supports(string $type, ?string $value): bool
    {
        return
            ('integer' === $type || 'int' === $type)
            && null !== filter_var($value, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE)
        ;
    }

    public function format(?string $value)
    {
        return filter_var($value, FILTER_VALIDATE_INT);
    }
}
