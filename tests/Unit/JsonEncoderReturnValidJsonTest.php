<?php

namespace Csv2Json\Tests\Unit\JsonEncoder;

use Csv2Json\JsonEncoder;
use Csv2Json\Tests\TestCase;

(new class() extends TestCase {
    public function __invoke()
    {
        $data = [
            'json' => true,
        ];
        $encoder = new JsonEncoder();
        $encoded = $encoder->encode($data, false);

        $this->assertEquals($encoded, json_encode($data));
    }
})();
