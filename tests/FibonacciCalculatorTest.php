<?php

namespace AMSOnline\Tests;

use PHPUnit\Framework\TestCase;
use AMSOnline\FibonacciCalculator;

final class FibonacciCalculatorTest extends TestCase
{
    private $calculator;

    protected function setUp(): void
    {
        $this->calculator = new FibonacciCalculator();
    }

    protected function tearDown(): void
    {
        unset($this->calculator);
    }

    public function testGetNumberOutOfRangePositive()
    {
        $this->expectException(AMSOnline\Exceptions\OutOfRangeException::class);
        $this->calculator->getNumber(50000);
    }

    public function testGetNumberOutOfRangeNegative()
    {
        $this->expectExceptionCode(400);
        $this->calculator->getNumber(-50000);
    }

    /**
     * @dataProvider provider
     */
    public function testGetNumberProvider($a, $b)
    {
        $this->assertEquals($this->calculator->getNumber($a), $b);
    }

    public function provider() : array
    {
        return [
            [8, 21],
            [-6, -8],
            [3.25, 2],
            [375, 1.0492526906656455E+78],
            [-570, -5.935672630284151E+118],
            [1000, 4.346655768693743E+208]
        ];
    }
}
