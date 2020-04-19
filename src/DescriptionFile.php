<?php

namespace Csv2Json;

class DescriptionFile
{
    /**
     * @return TypeMapping[]
     */
    public function parse(string $descriptionFilePath)
    {
        if (!is_readable($descriptionFilePath)) {
            throw new \InvalidArgumentException("File {$descriptionFilePath} is not readable");
        }

        $lines = file($descriptionFilePath);

        $mapping = [];
        foreach ($lines as $line) {
            if (preg_match('/^(\w+) ?= ?(\?)?(\w+).*$/', $line, $matches)) {
                $mapping[$matches[1]] = new TypeMapping($matches[1], $matches[3], $matches[2] === '?');
            }
        }

        return $mapping;
    }
}