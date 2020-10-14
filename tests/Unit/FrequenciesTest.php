<?php

use App\Scheduler\Frequencies;
use PHPUnit\Framework\TestCase;

class FrequenciesTest extends TestCase
{
    public function test_can_set_plain_cron_expression()
    {
        $frequencies = $this->frequencies();
        $frequencies->cron('abc');

        $this->assertEquals($frequencies->expression, 'abc');
    }

    public function test_can_replace_into_expression_at_position()
    {
        $frequencies = $this->frequencies();
        $frequencies->replaceIntoExpression(1, 1);

        $this->assertEquals($frequencies->expression, '1 * * * *');
    }

    public function test_can_replace_into_expression_by_chaining()
    {
        $frequencies = $this->frequencies();
        $frequencies->replaceIntoExpression(1, 1)
                    ->replaceIntoExpression(2, 2);

        $this->assertEquals($frequencies->expression, '1 2 * * *');
    }

    public function test_can_replace_into_expression_with_an_array()
    {
        $frequencies = $this->frequencies();
        $frequencies->replaceIntoExpression(1, [1, 2]);

        $this->assertEquals($frequencies->expression, '1 2 * * *');
    }

    public function test_cannot_replace_into_expression_past_the_end_of_expression()
    {
        $frequencies = $this->frequencies();
        $frequencies->replaceIntoExpression(5, [1, 2]);

        $this->assertEquals($frequencies->expression, '* * * * 1');
    }

    public function test_can_set_every_minute()
    {
        $frequencies = $this->frequencies();
        $frequencies->everyMinute();

        $this->assertEquals($frequencies->expression, '* * * * *');
    }

    public function test_can_set_every_ten_minutes()
    {
        $frequencies = $this->frequencies();
        $frequencies->everyTenMinutes();

        $this->assertEquals($frequencies->expression, '*/10 * * * *');
    }

    public function test_can_set_every_thirty_minutes()
    {
        $frequencies = $this->frequencies();
        $frequencies->everyThirtyMinutes();

        $this->assertEquals($frequencies->expression, '*/30 * * * *');
    }

    public function test_can_set_hourly_at()
    {
        $frequencies = $this->frequencies();
        $frequencies->hourlyAt(45);

        $this->assertEquals($frequencies->expression, '45 * * * *');
    }

    public function test_can_set_hourly()
    {
        $frequencies = $this->frequencies();
        $frequencies->hourly();

        $this->assertEquals($frequencies->expression, '1 * * * *');
    }

    public function test_can_set_daily_at()
    {
        $frequencies = $this->frequencies();
        $frequencies->dailyAt(12, 30);

        $this->assertEquals($frequencies->expression, '30 12 * * *');
    }

    public function test_can_set_daily()
    {
        $frequencies = $this->frequencies();
        $frequencies->daily();

        $this->assertEquals($frequencies->expression, '0 0 * * *');
    }

    public function test_can_set_twice_daily()
    {
        $frequencies = $this->frequencies();
        $frequencies->twiceDaily(6, 12);

        $this->assertEquals($frequencies->expression, '0 6,12 * * *');
    }

    public function test_can_set_twice_daily_using_default_values()
    {
        $frequencies = $this->frequencies();
        $frequencies->twiceDaily();

        $this->assertEquals($frequencies->expression, '0 1,12 * * *');
    }

    public function test_can_set_days()
    {
        $frequencies = $this->frequencies();
        $frequencies->days(1, 3, 5);

        $this->assertEquals($frequencies->expression, '* * * * 1,3,5');
    }

    public function test_can_set_mondays()
    {
        $frequencies = $this->frequencies();
        $frequencies->mondays();

        $this->assertEquals($frequencies->expression, '* * * * 1');
    }

    public function test_can_set_tuesdays()
    {
        $frequencies = $this->frequencies();
        $frequencies->tuesdays();

        $this->assertEquals($frequencies->expression, '* * * * 2');
    }

    public function test_can_set_wednesdays()
    {
        $frequencies = $this->frequencies();
        $frequencies->wednesdays();

        $this->assertEquals($frequencies->expression, '* * * * 3');
    }

    public function test_can_set_thursdays()
    {
        $frequencies = $this->frequencies();
        $frequencies->thursdays();

        $this->assertEquals($frequencies->expression, '* * * * 4');
    }

    public function test_can_set_fridays()
    {
        $frequencies = $this->frequencies();
        $frequencies->fridays();

        $this->assertEquals($frequencies->expression, '* * * * 5');
    }

    public function test_can_set_saturdays()
    {
        $frequencies = $this->frequencies();
        $frequencies->saturdays();

        $this->assertEquals($frequencies->expression, '* * * * 6');
    }

    public function test_can_set_sundays()
    {
        $frequencies = $this->frequencies();
        $frequencies->sundays();

        $this->assertEquals($frequencies->expression, '* * * * 7');
    }

    public function test_can_set_weekdays()
    {
        $frequencies = $this->frequencies();
        $frequencies->weekdays();

        $this->assertEquals($frequencies->expression, '* * * * 1,2,3,4,5');
    }

    public function test_can_set_weekends()
    {
        $frequencies = $this->frequencies();
        $frequencies->weekends();

        $this->assertEquals($frequencies->expression, '* * * * 6,7');
    }

    public function test_can_set_at_time()
    {
        $frequencies = $this->frequencies();
        $frequencies->at(12, 30);

        $this->assertEquals($frequencies->expression, '30 12 * * *');
    }

    public function test_can_set_day_and_time()
    {
        $frequencies = $this->frequencies();
        $frequencies->at(12, 30)->weekdays();

        $this->assertEquals($frequencies->expression, '30 12 * * 1,2,3,4,5');
    }

    public function test_can_set_monthly()
    {
        $frequencies = $this->frequencies();
        $frequencies->monthly();

        $this->assertEquals($frequencies->expression, '0 0 1 * *');
    }

    public function test_can_set_monthly_on_specified_day()
    {
        $frequencies = $this->frequencies();
        $frequencies->monthlyOn(10);

        $this->assertEquals($frequencies->expression, '0 0 10 * *');
    }

    public function test_expression_replacement_works_correctly()
    {
        $frequencies = $this->frequencies();
        $frequencies->daily()->daily();

        $this->assertEquals($frequencies->expression, '0 0 * * *');
    }

    protected function frequencies()
    {
        $frequencies = $this->getMockForTrait(Frequencies::class);
        $frequencies->expression = '* * * * *';

        return $frequencies;
    }
}
