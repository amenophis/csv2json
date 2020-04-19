<?php

namespace Csv2Json\Tests\Unit\Encoder;

use Csv2Json\Encoder\JsonEncoder;

return (new class
{
    public function __invoke()
    {
        $data = [
            'json' => true
        ];
        $encoder = new JsonEncoder();
        $encoded = $encoder->encode($data, false);

        return $encoded === json_encode($data);
    }
})();