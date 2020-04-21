<?php

namespace Csv2Json\Formatter\DescriptionFile;

use Csv2Json\Formatter\Exception\NoMappingExistsForFieldException;

class DescriptionFile
{
    private array $mapping;

    /**
     * @param TypeMapping[] $mapping
     */
    private function __construct(array $mapping)
    {
        $this->mapping = $mapping;
    }

    public static function parse(string $descriptionFilePath): self
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

        return new self($mapping);
    }

    /**
     * @throws NoMappingExistsForFieldException
     */
    public function getType(string $fieldName): TypeMapping
    {
        $mapping = $this->mapping[$fieldName] ?? null;
        if (null !== $mapping) {
            return $mapping;
        }

        throw NoMappingExistsForFieldException::create($fieldName);
    }
}