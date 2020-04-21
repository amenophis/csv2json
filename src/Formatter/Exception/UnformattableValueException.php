<?php

namespace Csv2Json\Formatter\Exception;

class UnformattableValueException extends \InvalidArgumentException
{
    public static function create(): self
    {
        return new self('Unformattable value exception');
    }
}