<?php

namespace Csv2Json\Exception;

class NoMappingExistsForFieldException extends \Exception
{
    public static function create(string $fieldName)
    {
        return new self("No mapping exists for {$fieldName} field");
    }
}
