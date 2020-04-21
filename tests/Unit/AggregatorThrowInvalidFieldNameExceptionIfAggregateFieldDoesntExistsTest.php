<?php

namespace Csv2Json\Tests\Unit\Encoder;

use Csv2Json\Aggregator;
use Csv2Json\Exception\InvalidFieldException;
use Csv2Json\Tests\TestCase;

(new class() extends TestCase {
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

        $this->expectException(InvalidFieldException::class, function () use ($aggregator, $data) {
            $data = $aggregator->aggregate($data, 'lastname');
            dd($data);
        });
    }
})();
