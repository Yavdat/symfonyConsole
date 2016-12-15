<?php

function app_autoload($class)
{
    $filename=__DIR__.'/'.str_replace('\\','/',$class).'.php';
    if(file_exists($filename))
    {
        include $filename;
    }
}

spl_autoload_register('app_autoload');


include __DIR__.'/vendor/autoload.php';
