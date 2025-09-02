<?php
if (! function_exists('cekRange')) {
    function cekRange($value, $min, $max) {
        if ($value === null) return '';
        return ($value < $min || $value > $max) ? 'text-danger fw-bold' : '';
    }
}
