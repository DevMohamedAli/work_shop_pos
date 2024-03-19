<?php

if(!function_exists('Rupiah')) {
    function Rupiah($str) {
        return '.دل '. number_format($str, '0', ''. '.');
    }
}
