<?php

namespace Csv2Json\DescriptionFile;

class TypeMapping
{
    private string $field;
    private string $type;
    private bool $nullable;

    public function __construct(string $field, string $type, bool $nullable)
    {
        $this->field = $field;
        $this->type = $type;
        $this->nullable = $nullable;
    }

    public function getField(): string
    {
        return $this->field;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function isNullable(): bool
    {
        return $this->nullable;
    }
}
