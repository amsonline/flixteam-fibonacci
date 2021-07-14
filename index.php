<?php
    require_once "vendor/autoload.php";

    $fibonacci = new FibonacciCalculator();

    $number = 100;

    echo $fibonacci->getNumber($number);
