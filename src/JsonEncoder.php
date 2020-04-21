<?php

namespace Csv2Json;

use Csv2Json\Exception\UnableToEncodeJsonException;

final class JsonEncoder
{
    /**
     * @throws UnableToEncodeJsonException
     */
    public function encode(array $data, bool $pretty): string
    {
        try {
            return json_encode(
                $data,
                ($pretty ? JSON_PRETTY_PRINT : 0) | JSON_THROW_ON_ERROR
            );
        } catch (\JsonException $e) {
            throw UnableToEncodeJsonException::create($e->getMessage());
        }
    }
}
