<?php
//error_reporting(E_STRICT);
declare(strict_types=1);

$something = 'Requested URL';

$num = 1;

doing($something);

function doing(string $thing){
    echo $thing . ' = "' . $_SERVER['QUERY_STRING'] . '"';
}