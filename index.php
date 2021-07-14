<?php
    require_once "Fibonacci.class.php";

    $fibonacci = new FibonacciCalculator();

    $number = 30;

    echo $fibonacci->getNumber($number);
