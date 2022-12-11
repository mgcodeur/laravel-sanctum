<?php

if (! function_exists('to_singular')) {
    function to_singular($string): array|string|null
    {
        return preg_replace('/s$/', '', $string);
    }
}
