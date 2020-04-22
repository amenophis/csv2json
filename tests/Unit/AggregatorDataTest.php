<?php

namespace Csv2Json\Tests\Unit;

use Csv2Json\Aggregator;
use Csv2Json\Exception\InvalidFieldException;
use Csv2Json\Tests\TestCase;

return new class() extends TestCase
{
    public function __invoke()
    {
        $this->testGroupByFieldName();
        $this->testThrowExceptionIfAggregateFieldDoesntEsists();
    }

    private function testGroupByFieldName()
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

    private function testThrowExceptionIfAggregateFieldDoesntEsists()
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
            $aggregator->aggregate($data, 'lastname');
        });
    }
};
