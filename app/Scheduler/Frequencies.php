<?php

namespace App\Scheduler;

trait Frequencies
{
    /**
     * Set the value of the cron expression to the given value.
     *
     * @param string $expression
     * @return \App\Scheduler\Frequencies
     */
    public function cron($expression)
    {
        $this->expression = $expression;

        return $this;
    }

    /**
     * Replace the value in the expression at the given position.
     *
     * @param integer $position
     * @param mixed $value
     * @return \App\Scheduler\Frequencies
     */
    public function replaceIntoExpression($position, $value)
    {
        $value = (array) $value;

        $expression = explode(' ', $this->expression);

        array_splice($expression, $position - 1, count($value), $value);

        $expression = array_slice($expression, 0, 5);

        return $this->cron(implode(' ', $expression));
    }

    /**
     * Run the event every minute.
     *
     * @return \App\Scheduler\Frequencies
     */
    public function everyMinute()
    {
        return $this->cron($this->expression);
    }

    /**
     * Run the event every ten minutes.
     *
     * @return \App\Scheduler\Frequencies
     */
    public function everyTenMinutes()
    {
        return $this->replaceIntoExpression(1, '*/10');
    }

    /**
     * Run the event every thirty minutes.
     *
     * @return \App\Scheduler\Frequencies
     */
    public function everyThirtyMinutes()
    {
        return $this->replaceIntoExpression(1, '*/30');
    }

    /**
     * Run the event hourly at the specified minute.
     *
     * @param integer $minute
     * @return \App\Scheduler\Frequencies
     */
    public function hourlyAt($minute = 1)
    {
        return $this->replaceIntoExpression(1, $minute);
    }

    /**
     * Run the event hourly.
     *
     * @return \App\Scheduler\Frequencies
     */
    public function hourly()
    {
        return $this->hourlyAt(1);
    }

    /**
     * Run the event daily at the specified time.
     *
     * @param integer $hour
     * @param integer $minute
     * @return \App\Scheduler\Frequencies
     */
    public function dailyAt($hour = 0, $minute = 0)
    {
        return $this->replaceIntoExpression(1, [$minute, $hour]);
    }

    /**
     * Run the event daily.
     *
     * @return \App\Scheduler\Frequencies
     */
    public function daily()
    {
        return $this->dailyAt(0, 0);
    }

    /**
     * Run the event twice daily at the specified hours.
     *
     * @param integer $firstHour
     * @param integer $secondHour
     * @return \App\Scheduler\Frequencies
     */
    public function twiceDaily($firstHour = 1, $secondHour = 12)
    {
        return $this->replaceIntoExpression(1, [0, "{$firstHour},{$secondHour}"]);
    }

    /**
     * Run the event on the specified days.
     *
     * @return \App\Scheduler\Frequencies
     */
    public function days()
    {
        return $this->replaceIntoExpression(5, implode(',', func_get_args() ?: ['*']));
    }

    /**
     * Run the event on Mondays.
     *
     * @return \App\Scheduler\Frequencies
     */
    public function mondays()
    {
        return $this->days(1);
    }

    /**
     * Run the event on Tuesdays.
     *
     * @return \App\Scheduler\Frequencies
     */
    public function tuesdays()
    {
        return $this->days(2);
    }

    /**
     * Run the event on Wednesdays.
     *
     * @return \App\Scheduler\Frequencies
     */
    public function wednesdays()
    {
        return $this->days(3);
    }

    /**
     * Run the event on Thursdays.
     *
     * @return \App\Scheduler\Frequencies
     */
    public function thursdays()
    {
        return $this->days(4);
    }

    /**
     * Run the event on Fridays.
     *
     * @return \App\Scheduler\Frequencies
     */
    public function fridays()
    {
        return $this->days(5);
    }

    /**
     * Run the event on Saturdays.
     *
     * @return \App\Scheduler\Frequencies
     */
    public function saturdays()
    {
        return $this->days(6);
    }

    /**
     * Run the event on Sundays.
     *
     * @return \App\Scheduler\Frequencies
     */
    public function sundays()
    {
        return $this->days(7);
    }

    /**
     * Run the event on weekdays.
     *
     * @return \App\Scheduler\Frequencies
     */
    public function weekdays()
    {
        return $this->days(1, 2, 3, 4, 5);
    }

    /**
     * Run the event on weekends.
     *
     * @return \App\Scheduler\Frequencies
     */
    public function weekends()
    {
        return $this->days(6, 7);
    }

    /**
     * Run the event at the specified time.
     *
     * @param integer $hour
     * @param integer $minute
     * @return \App\Scheduler\Frequencies
     */
    public function at($hour = 0, $minute = 0)
    {
        return $this->dailyAt($hour, $minute);
    }

    /**
     * Run the event monthly.
     *
     * @return \App\Scheduler\Frequencies
     */
    public function monthly()
    {
        return $this->monthlyOn(1);
    }

    /**
     * Run the event monthly on the specified day.
     *
     * @param integer $day
     * @return \App\Scheduler\Frequencies
     */
    public function monthlyOn($day = 1)
    {
        return $this->replaceIntoExpression(1, [0, 0, $day]);
    }
}
