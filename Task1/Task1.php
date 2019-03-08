<?php
    $fib[0] = 0;
    $fib[1] = 1;
    echo $fib[0].' '.$fib[1].' ';
    for ($i = 2;$i < 64;$i++) {
        $fib[$i] = $fib[$i-1] + $fib[$i-2];
        echo $fib[$i].' ';
    }
