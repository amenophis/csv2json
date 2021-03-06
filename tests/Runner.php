<?php

namespace Csv2Json\Tests;

class Runner
{
    public function run(array $args): int
    {
        $filter = '/^.+Test\.php$/i';
        if (2 === \count($args)) {
            $filter = "/^.+{$args[1]}\.php$/i";
        }

        $testsIterator = new \RegexIterator(
            new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator(__DIR__.'/Unit')
            ),
            $filter
        );

        $testCounter = 0;
        $testsSuccess = [];
        $testsFailure = [];
        $testsErrors = [];

        /** @var \SplFileInfo $file */
        foreach ($testsIterator as $file) {
            try {
                /** @var TestCase $testCase */
                $testCase = require $file->getPathname();
                $testCase();

                $testsSuccess[] = $file->getFilename();
            } catch (AssertException $e) {
                $testsFailure[] = $file->getFilename();
            } catch (\Throwable $e) {
                $testsErrors[] = $file->getFilename();
            } finally {
                ++$testCounter;
            }
        }

        printf("Tests executed: %d\n\n", $testCounter);
        printf("Tests KO: %d\n", \count($testsFailure));
        printf("Tests Errors: %d\n", \count($testsErrors));
        foreach ($testsFailure as $fail) {
            printf("* %s\n", $fail);
        }

        return $testCounter === \count($testsSuccess) ? 0 : 1;
    }
}
