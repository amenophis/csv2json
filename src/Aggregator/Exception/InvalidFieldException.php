<?php

namespace Csv2Json\Aggregator\Exception;

class InvalidFieldException extends \InvalidArgumentException
{
    public static function create(string $fieldName): self
    {
        return new self("The field {$fieldName} doesn't exists");
    }
}
