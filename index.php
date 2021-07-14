<?php
    require_once "Fibonacci.class.php";

    $fibonacci = new FibonacciCalculator();

    $number = -1;

    echo $fibonacci->getNumber($number);
