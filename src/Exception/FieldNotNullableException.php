<?php

namespace Csv2Json\Exception;

class FieldNotNullableException extends \Exception
{
    public static function create(): self
    {
        return new self('Not nullable field');
    }
}
