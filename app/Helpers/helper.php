<?php

if (!function_exists('formatExpense')) {
    function formatExpense($expense)
    {
        if ($expense >= 1000000) {
            return '$ ' . number_format($expense / 1000000, 1) . 'M';
        } elseif ($expense >= 1000) {
            return '$ ' . number_format($expense / 1000, 1) . 'K';
        }
        return '$ ' . $expense;
    }
}
