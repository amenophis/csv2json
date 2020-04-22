<?php

namespace Csv2Json;

use Csv2Json\DescriptionFile\DescriptionFile;
use Csv2Json\Exception\FieldNotNullableException;
use Csv2Json\Exception\NoMappingExistsForFieldException;
use Csv2Json\Exception\UnformatableValueException;
use Csv2Json\TypeFormatter\TypeFormatter;

final class Formatter
{
    /**
     * @var TypeFormatter[]
     */
    private array $typeFormatters;

    public function __construct(TypeFormatter ...$typeFormatters)
    {
        $this->typeFormatters = $typeFormatters;
    }

    /**
     * @throws NoMappingExistsForFieldException
     * @throws FieldNotNullableException
     * @throws UnformatableValueException
     */
    public function format(DescriptionFile $descriptionFile, array $data): array
    {
        foreach ($data as $fieldName => &$value) {
            if (\is_array($value)) {
                $value = $this->format($descriptionFile, $value);
                continue;
            }

            $fieldType = $descriptionFile->getType($fieldName);
            if ('' === $value && !$fieldType->isNullable()) {
                throw FieldNotNullableException::create();
            }

            foreach ($this->typeFormatters as $typeFormatter) {
                if ($typeFormatter->supports($fieldType->getType(), $value)) {
                    $value = $typeFormatter->format($value);
                    continue 2;
                }
            }

            throw UnformatableValueException::create();
        }

        return $data;
    }
}
