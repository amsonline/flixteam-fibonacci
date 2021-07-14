<?php
    require_once "Fibonacci.php";

    class FibonacciCalculator implements Fibonacci {
        public function getNumber(int $n)
        {
            if ($n == 0) {
                return 0;
            }

            if ($n == 1) {
                return 1;
            }

            // In case $n > 3
            $penultimateNumber = 0;
            $ultimateNumber = 1;
            for ($i = 3; $i <= $n; $i++) {
                $currentNumber = $penultimateNumber + $ultimateNumber;
                $penultimateNumber = $ultimateNumber;
                $ultimateNumber = $currentNumber;
            }

            return $currentNumber;
        }
    }