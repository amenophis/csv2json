<?php

namespace Csv2Json\Exception;

class UnableToEncodeJsonException extends \Exception
{
    public static function create(string $error): self
    {
        return new self($error);
    }
}
