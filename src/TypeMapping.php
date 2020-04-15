<?php

class TypeMapping
{
    private const ALLOWED_TYPES = ['string', 'int', 'integer', 'float', 'bool', 'boolean', 'date', 'time', 'datetime'];

    private string $field;
    private string $type;
    private bool $nullable;

    public function __construct(string $field, string $type, bool $nullable)
    {
        if (!in_array($type, self::ALLOWED_TYPES, true)) {
            throw new \InvalidArgumentException(sprintf(
                'The type "%s" is not valid. Allowed: "%s"',
                $type,
                implode('","', self::ALLOWED_TYPES)
            ));
        }
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