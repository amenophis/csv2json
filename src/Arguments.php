<?php

final class Arguments
{
    private ?string $csvFilePath;
    private ?array $fields;
    private ?string $aggregate;
    private ?string $descriptionFilePath;
    private ?bool $pretty;

    private $parsingErrors = [];

    private function __construct(?string $csvFilePath, ?string $fields, ?string $aggregate, ?string $descriptionFilePath, bool $pretty)
    {
        if (null === $fields) {
            $this->parsingErrors[] = 'Argument "fields" is required';
        } elseif (1 !== preg_match('/^\w+(?:,\w+)*$/', $fields)) {
            $this->parsingErrors[] = 'Argument "fields" must looks like field1,field2,field3';
        }

        if (null === $aggregate) {
            $this->parsingErrors[] = 'Argument "aggregate" is required';
        }

        if (null === $descriptionFilePath) {
            $this->parsingErrors[] = 'Argument "desc" is required';
        }

        if ($this->hasParsingErrors()) {
            return;
        }

        $this->csvFilePath = $csvFilePath;
        $this->fields = explode(',', $fields);
        $this->aggregate = $aggregate;
        $this->descriptionFilePath = $descriptionFilePath;
        $this->pretty = $pretty;
    }

    /**
     * @throws \InvalidArgumentException
     */
    public static function parse(array $args): self
    {
        $parsedArgs = [];

        if (count($args) > 2) {
            // Remove the script name
            array_shift($args);

            $parsedArgs['csvFilePath'] = array_shift($args);

            do {
                $name = str_replace('--', '', array_shift($args));
                $value = ($name === 'pretty') ? true : array_shift($args);

                $parsedArgs[$name] = $value;
            } while (count($args) > 0);
        }

        return new self(
            $parsedArgs['csvFilePath'] ?? null,
            $parsedArgs['fields'] ?? null,
            $parsedArgs['aggregate'] ?? null,
            $parsedArgs['desc'] ?? null,
            $parsedArgs['pretty'] ?? false
        );
    }

    public function hasParsingErrors(): bool
    {
        return count($this->parsingErrors) > 0;
    }

    public function getParsingErrors(): array
    {
        return $this->parsingErrors;
    }

    public function getCsvFilePath(): ?string
    {
        return $this->csvFilePath;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function getAggregate(): string
    {
        return $this->aggregate;
    }

    public function getDescriptionFilePath(): string
    {
        return $this->descriptionFilePath;
    }

    public function isPretty(): bool
    {
        return $this->pretty;
    }
}