<?php

namespace Csv2Json\Tests\Unit\JsonEncoder;

use Csv2Json\JsonEncoder;
use Csv2Json\Tests\TestCase;

return new class() extends TestCase {
    public function __invoke()
    {
        $data = [
            'json' => true,
        ];
        $encoder = new JsonEncoder();
        $encoded = $encoder->encode($data, true);

        $this->assertEquals($encoded, json_encode($data, JSON_PRETTY_PRINT));
    }
};
