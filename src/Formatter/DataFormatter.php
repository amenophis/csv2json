<?php

namespace Csv2Json\Formatter;

use Csv2Json\Formatter\Type\FormatterType;
use Csv2Json\TypeMapping;

final class DataFormatter
{
    /**
     * @var FormatterType[]
     */
    private array $types;

    /**
     * @var TypeMapping[]
     */
    private array $mapping;

    public function __construct(array $mapping, FormatterType ...$types)
    {
        $this->mapping = $mapping;
        $this->types = $types;
    }

    public function format(array $data): array
    {
        foreach ($data as $fieldName => &$value) {
            $fieldType = $this->mapping[$fieldName];
            foreach ($this->types as $type) {
                if ('' === $value && !$fieldType->isNullable()) {
                    throw FieldNotNullableException::create();
                }

                if ($type->supports($fieldType->getType(), $value)) {
                    $value = $type->format($value);
                    continue 2;
                }
            }

            throw UnformattableValueException::create();
        }

        return $data;
    }
}