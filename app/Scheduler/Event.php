<?php

namespace App\Scheduler;

use Carbon\Carbon;
use Cron\CronExpression;
use App\Scheduler\Frequencies;

abstract class Event
{
    use Frequencies;

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
     * Determine if the event should run.
     *
     * @param \Carbon\Carbon $date
     * @return boolean
     */
    public function isDueToRun(Carbon $date)
    {
        return CronExpression::factory($this->expression)->isDue($date);
    }
}
