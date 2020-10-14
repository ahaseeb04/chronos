<?php

namespace App\Events;

use App\Scheduler\Event;

class SomeEvent extends Event
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        var_dump($this->expression);
    }
}
