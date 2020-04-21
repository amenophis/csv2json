<?php

namespace Csv2Json\JsonEncoder\Exception;

class UnableToEncodeJsonException extends \InvalidArgumentException
{
    public static function create(string $error): self
    {
        return new self();
    }
}
