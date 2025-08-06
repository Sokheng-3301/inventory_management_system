<?php

    
    echo 'hi';

    header('location: google.com');
    exit;

    if (!function_exists('example_function')) {
        function example_function($arg) {
            return "Hello, " . $arg;
        }
    }

