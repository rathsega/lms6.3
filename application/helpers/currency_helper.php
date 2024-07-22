<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('format_currency')) {
    function format_currency($amount) {
        $formatted_amount = number_format($amount, 2, '.', ',');
        $formatted_amount = preg_replace('/(\d+)(?=(\d{3})+(?!\d))/', '$1,', $amount);
        
        $exploded = explode('.', $formatted_amount);
        $whole = $exploded[0];
        $decimal = isset($exploded[1]) ? $exploded[1] : '00';
        
        // Convert the number into Indian number format
        $whole = ltrim(preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $whole), ',');
        $val = $exploded[1] ? $whole . '.' . $decimal : $whole ;

        return '₹' . $val;
    }
}
