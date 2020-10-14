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

        array_splice($expression, $position - 1, 1, $value);

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
}
