<?php
function app_format_number($key):string{
    return number_format($key, 1, ',', ' ');
}
function app_get_percentage(float $val):float{
    return $val*(10/100);
}
