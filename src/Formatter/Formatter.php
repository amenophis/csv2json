<?php

namespace Csv2Json\Formatter;

use Csv2Json\Formatter\DescriptionFile\DescriptionFile;
use Csv2Json\Formatter\Exception\FieldNotNullableException;
use Csv2Json\Formatter\Exception\NoMappingExistsForFieldException;
use Csv2Json\Formatter\Exception\UnformattableValueException;
use Csv2Json\Formatter\Type\FormatterType;

final class Formatter
{
    /**
     * @var FormatterType[]
     */
    private array $types;

    public function __construct(FormatterType ...$types)
    {
        $this->types = $types;
    }

    /**
     * @throws NoMappingExistsForFieldException
     * @throws FieldNotNullableException
     * @throws UnformattableValueException
     */
    public function format(DescriptionFile $descriptionFile, array $data): array
    {
        foreach ($data as $fieldName => &$value) {
            $fieldType = $descriptionFile->getType($fieldName);
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
