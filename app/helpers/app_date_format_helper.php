<?php
function app_get_month_name($key):string{
    setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
    $date   = DateTime::createFromFormat('!m', $key);
    return $date->format('F');
}
