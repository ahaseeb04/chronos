<?php

use Carbon\Carbon;
use App\Scheduler\Event;
use App\Scheduler\Kernel;
use PHPUnit\Framework\TestCase;

class KernelTest extends TestCase
{
    public function test_can_get_a_list_of_events()
    {
        $kernel = new Kernel();

        $this->assertEquals([], $kernel->getEvents());
    }

    public function test_can_add_events()
    {
        $kernel = new Kernel();
        $kernel->add($this->getMockForAbstractClass(Event::class));

        $this->assertCount(1, $kernel->getEvents());
    }

    public function test_adding_event_returns_event()
    {
        $kernel = new Kernel();
        $result = $kernel->add($this->getMockForAbstractClass(Event::class));

        $this->assertInstanceOf(Event::class, $result);
    }

    public function test_can_set_date()
    {
        $kernel = new Kernel();
        $kernel->setDate(Carbon::now());

        $this->assertInstanceOf(Carbon::class, $kernel->getDate());
    }

    public function test_has_default_date_set()
    {
        $kernel = new Kernel();

        $this->assertInstanceOf(Carbon::class, $kernel->getDate());
    }

    public function test_runs_expected_event()
    {
        $kernel = new Kernel();
        $event = $this->getMockForAbstractClass(Event::class);

        $kernel->add($event);

        $event->expects($this->once())->method('handle');

        $kernel->run();
    }

    public function test_does_not_run_unexpected_event()
    {
        $kernel = new Kernel();
        $kernel->setDate(Carbon::create(2015, 10, 5, 0, 0, 0));

        $event = $this->getMockForAbstractClass(Event::class);
        $event->monthly();

        $kernel->add($event);

        $event->expects($this->never())->method('handle');

        $kernel->run();
    }
}
