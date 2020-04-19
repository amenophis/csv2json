<?php

namespace Csv2Json\Formatter\Type;

interface FormatterType
{
    public function supports(string $type, ?string $value): bool;
    public function format(?string $value);
}