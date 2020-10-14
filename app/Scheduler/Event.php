<?php

namespace App\Scheduler;

use Carbon\Carbon;
use Cron\CronExpression;

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

    /**
     * Determine if the task should run.
     *
     * @param \Carbon\Carbon $date
     * @return boolean
     */
    public function isDueToRun(Carbon $date)
    {
        return CronExpression::factory($this->expression)->isDue($date);
    }
}
