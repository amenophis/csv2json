<?php

namespace Csv2Json\DescriptionFile;

use Csv2Json\Exception\FileCannotBeOpenedException;
use Csv2Json\Exception\NoMappingExistsForFieldException;

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
        if (!is_readable($descriptionFilePath) || !is_file($descriptionFilePath)) {
            throw new FileCannotBeOpenedException($descriptionFilePath);
        }

        $lines = file($descriptionFilePath);

        $mapping = [];
        foreach ($lines as $line) {
            if (preg_match('/^(\w+) ?= ?(\?)?(\w+).*$/', $line, $matches)) {
                $mapping[$matches[1]] = new TypeMapping($matches[1], $matches[3], '?' === $matches[2]);
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
