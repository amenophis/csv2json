<?php

class DescriptionFile
{
    /**
     * @var TypeMapping[]
     */
    private array $mapping = [];

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
                $mapping[] = new TypeMapping($matches[1], $matches[3], $matches[2] === '?');
            }
        }

        return new self($mapping);
    }

    /**
     * @return TypeMapping[]
     */
    public function getMapping(): array
    {
        return $this->mapping;
    }
}