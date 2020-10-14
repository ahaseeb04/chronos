<?php

use App\Scheduler\Event;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    public function test_event_has_a_default_cron_expression()
    {
        $event = $this->getMockForAbstractClass(Event::class);

        $this->assertEquals($event->expression, '* * * * *');
    }
}
