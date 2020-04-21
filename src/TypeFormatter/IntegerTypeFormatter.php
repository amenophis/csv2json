<?php

namespace Csv2Json\TypeFormatter;

class IntegerTypeFormatter implements TypeFormatter
{
    public function supports(string $type, ?string $value): bool
    {
        return 'integer' === $type || 'int' === $type;
    }

    public function format(?string $value)
    {
        return (int) $value;
    }
}
