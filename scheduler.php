<?php

require_once 'vendor/autoload.php';

$kernel = new \App\Scheduler\Kernel();

$kernel->add(new \App\Events\SomeEvent())->everyMinute();

$kernel->run();
