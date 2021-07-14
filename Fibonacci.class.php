<?php
require_once "Fibonacci.php";

class FibonacciCalculator implements Fibonacci {
    public function getNumberByFormula(int $n) {
        $sqrtMultiplier = sqrt(5);
        return floatval(pow((1 + $sqrtMultiplier), $n) - pow((1 - $sqrtMultiplier), $n)) / floatval(pow(2, $n) * $sqrtMultiplier);
    }

    public function getNumber(int $n)
    {
        $finalMultiplier = 1;
        if ($n < 0) {
            /****************************
             * For negative numbers, we should continue the process with number's abs value,
             * but the final result will be multiplied with -1 if the number is divisible to 2
             ****************************/
            if (($n % 2) == 0) {
                $finalMultiplier = -1;
            }

            $n = -$n;
        }

        if ($n == 0) {
            return 0;
        }

        if ($n == 1) {
            return 1; // Fibonacci value of 1 and -1 are both 1
        }

        // In case $n > 3
        $penultimateNumber = 0;
        $ultimateNumber = 1;
        for ($i = 2; $i <= $n; $i++) {
            $currentNumber = $penultimateNumber + $ultimateNumber;
            $penultimateNumber = $ultimateNumber;
            $ultimateNumber = $currentNumber;
        }

        return $currentNumber * $finalMultiplier;
    }

    public function getNumberByRecursive(int $n)
    {
        if ($n == 0) {
            return 0;
        }

        if ($n == 1) {
            return 1;
        }

        return $this->getNumberByRecursive($n - 1) + $this->getNumberByRecursive($n - 2);
    }
}