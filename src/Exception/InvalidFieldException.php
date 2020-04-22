<?php

namespace Csv2Json\Exception;

class InvalidFieldException extends \Exception
{
    public static function create(string $fieldName): self
    {
        return new self("The field {$fieldName} doesn't exists");
    }
}
