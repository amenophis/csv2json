<?php

namespace Csv2Json\Exception;

class FileCannotBeOpenedException extends \Exception
{
    public static function create(string $fileName): self
    {
        return new self("The file {$fileName} can't be opened");
    }
}
