<?php

require __DIR__.'/autoload.php';

use App\Commands\Contact;
use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new Contact());

$application->run();





