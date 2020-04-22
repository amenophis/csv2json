<?php

namespace Csv2Json\TypeFormatter;

interface TypeFormatter
{
    public function supports(string $type, ?string $value): bool;

    public function format(?string $value);
}
