<?php

namespace App\Scheduler;

abstract class Event
{
    /**
     * The default cron expression.
     *
     * @var string
     */
    public $expression = '* * * * *';

    /**
     * Handle the event.
     *
     * @return void
     */
    abstract public function handle();
}
