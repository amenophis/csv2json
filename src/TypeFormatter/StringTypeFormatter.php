<?php

namespace Csv2Json\TypeFormatter;

class StringTypeFormatter implements TypeFormatter
{
    public function supports(string $type, ?string $value): bool
    {
        return 'string' === $type;
    }

    public function format(?string $value)
    {
        return $value ?? '';
    }
}
