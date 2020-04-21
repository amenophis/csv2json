<?php

namespace Csv2Json\Formatter\Exception;

class FieldNotNullableException extends \InvalidArgumentException
{
    public static function create(): self
    {
        return new self('Not nullable field');
    }
}
