<?php

namespace Csv2Json\Tests\Unit\Encoder;

use Csv2Json\Aggregator;
use Csv2Json\Tests\TestCase;

return new class() extends TestCase {
    public function __invoke()
    {
        $data = [
            [
                'firstname' => 'Dupond',
                'value' => 'Jean',
            ],
            [
                'firstname' => 'Dupond',
                'value' => 'Jacques',
            ],
            [
                'firstname' => 'Durand',
                'value' => 'Pierre',
            ],
            [
                'firstname' => 'Dupond',
                'value' => 'Thierry',
            ],
            [
                'firstname' => 'Durand',
                'value' => 'Etienne',
            ],
        ];
        $aggregator = new Aggregator();
        $data = $aggregator->aggregate($data, 'firstname');

        $this->assertEquals($data, [
            'Dupond' => [
                ['value' => 'Jean'],
                ['value' => 'Jacques'],
                ['value' => 'Thierry'],
            ],
            'Durand' => [
                ['value' => 'Pierre'],
                ['value' => 'Etienne'],
            ],
        ]);
    }
};
