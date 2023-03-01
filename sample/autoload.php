<?php

include '../vendor/autoload.php';

function dd(...$vars)
{
    var_dump($vars);
    die();
}

function response($var)
{
    echo json_encode($var);
    die();
}