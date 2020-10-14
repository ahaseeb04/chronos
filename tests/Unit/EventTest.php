<?php

use Carbon\Carbon;
use App\Scheduler\Event;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    public function test_event_has_a_default_cron_expression()
    {
        $event = $this->getMockForAbstractClass(Event::class);

        $this->assertEquals($event->expression, '* * * * *');
    }

    public function test_event_should_be_run()
    {
        $event = $this->getMockForAbstractClass(Event::class);

        $this->assertTrue($event->isDueToRun(Carbon::now()));
    }

    public function test_event_should_not_be_run()
    {
        $event = $this->getMockForAbstractClass(Event::class);
        $event->expression = '0 0 1 * *';

        $this->assertFalse($event->isDueToRun(Carbon::create(2015, 10, 5, 0, 0, 0)));
    }
}
