<?php

namespace Csv2Json\TypeFormatter;

class EmptyTypeFormatter implements TypeFormatter
{
    public function supports(string $type, ?string $value): bool
    {
        return '' === $value;
    }

    public function format(?string $value)
    {
        return null;
    }
}
