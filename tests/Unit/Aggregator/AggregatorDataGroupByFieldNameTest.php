<?php

namespace Csv2Json\Tests\Unit\Encoder;

use Csv2Json\Aggregator\DataAggregator;

return (new class
{
    public function __invoke()
    {
        $data = [
            [
                'firstname' => 'Dupond',
                'value' => 'Jean'
            ],
            [
                'firstname' => 'Dupond',
                'value' => 'Jacques'
            ],
            [
                'firstname' => 'Durand',
                'value' => 'Pierre'
            ],
            [
                'firstname' => 'Dupond',
                'value' => 'Thierry'
            ],
            [
                'firstname' => 'Durand',
                'value' => 'Etienne'
            ]
        ];
        $aggregator = new DataAggregator();
        $data = $aggregator->aggregate($data, 'firstname');

        return $data === [
            'Dupond' => [
                ['value' => 'Jean'],
                ['value' => 'Jacques'],
                ['value' => 'Thierry'],
            ],
            'Durand' => [
                ['value' => 'Pierre'],
                ['value' => 'Etienne'],
            ]
        ];
    }
})();