<?php

    require_once '../vendor/autoload.php';

    $fibonacci = new AMSOnline\FibonacciCalculator;

    $number = 10000;
    try {
        echo $fibonacci->getNumber($number);
    }catch (\AMSOnline\Exceptions\OutOfRangeException $e) {
        echo "Value out of range";
    }catch (Exception $e) {
        echo "Something went wrong";
    }
