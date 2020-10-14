<?php

namespace App\Scheduler;

use Carbon\Carbon;
use App\Scheduler\Event;

class Kernel
{
    /**
     * The events.
     *
     * @var array
     */
    protected $events = [];

    /**
     * The carbon instance.
     *
     * @var \Carbon\Carbon
     */
    protected $date;

    /**
     * Get the events that are added to the kernel.
     *
     * @return array
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Get the date.
     *
     * @return \Carbon\Carbon
     */
    public function getDate()
    {
        return $this->date ? $this->date : Carbon::now();
    }

    /**
     * Set the date property to the given carbon instance.
     *
     * @param \Carbon\Carbon $date
     * @return void
     */
    public function setDate(Carbon $date)
    {
        $this->date = $date;
    }

    /**
     * Add the given event to the kernel.
     *
     * @param \App\Scheduler\Event $event
     * @return \App\Scheduler\Event
     */
    public function add(Event $event)
    {
        $this->events[] = $event;

        return $event;
    }

    /**
     * Run the events that are added to the kernel.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getEvents() as $event) {
            if (!$event->isDueToRun($this->getDate())) {
                continue;
            }

            $event->handle();
        }
    }
}
