<?php

namespace Csv2Json\Exception;

class UnformatableValueException extends \Exception
{
    public static function create(): self
    {
        return new self('Unformatable value');
    }
}
