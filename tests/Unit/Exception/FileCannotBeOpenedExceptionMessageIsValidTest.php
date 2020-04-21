<?php

namespace Csv2Json\Tests\Unit\Exception;

use Csv2Json\Exception\FileCannotBeOpenedException;
use Csv2Json\Tests\TestCase;

(new class() extends TestCase {
    public function __invoke()
    {
        $e = FileCannotBeOpenedException::create($fileName = 'file-name');

        $this->assertEquals(
            "The file {$fileName} can't be opened",
            $e->getMessage()
        );
    }
})();
