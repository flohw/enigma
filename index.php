<?php

require_once 'vendor/autoload.php';

use App\ApplicationCommand;

use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new ApplicationCommand());
$application->run();
