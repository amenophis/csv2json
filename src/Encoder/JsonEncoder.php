<?php

namespace Csv2Json\Encoder;

final class JsonEncoder
{
    public function encode(array $data, bool $pretty): string
    {
        return json_encode($data, $pretty ? JSON_PRETTY_PRINT : 0);
    }
}