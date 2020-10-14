<?php

use App\Scheduler\Frequencies;
use PHPUnit\Framework\TestCase;

class FrequenciesTest extends TestCase
{
    public function test_can_set_plain_cron_expression()
    {
        $frequencies = $this->getMockForTrait(Frequencies::class);
        $frequencies->cron('abc');

        $this->assertEquals($frequencies->expression, 'abc');
    }

    public function test_can_replace_into_expression_at_position()
    {
        $frequencies = $this->getMockForTrait(Frequencies::class);
        $frequencies->expression = '* * * * *';
        $frequencies->replaceIntoExpression(1, 1);

        $this->assertEquals($frequencies->expression, '1 * * * *');
    }

    public function test_can_replace_into_expression_by_chaining()
    {
        $frequencies = $this->getMockForTrait(Frequencies::class);
        $frequencies->expression = '* * * * *';
        $frequencies->replaceIntoExpression(1, 1)->replaceIntoExpression(2, 2);

        $this->assertEquals($frequencies->expression, '1 2 * * *');
    }

    public function test_can_replace_into_expression_with_an_array()
    {
        $frequencies = $this->getMockForTrait(Frequencies::class);
        $frequencies->expression = '* * * * *';
        $frequencies->replaceIntoExpression(1, [1, 2]);

        $this->assertEquals($frequencies->expression, '1 2 * * *');
    }

    public function test_cannot_replace_into_expression_past_the_end_of_expression()
    {
        $frequencies = $this->getMockForTrait(Frequencies::class);
        $frequencies->expression = '* * * * *';
        $frequencies->replaceIntoExpression(5, [1, 2]);

        $this->assertEquals($frequencies->expression, '* * * * 1');
    }

    public function test_can_set_every_minute()
    {
        $frequencies = $this->getMockForTrait(Frequencies::class);
        $frequencies->expression = '* * * * *';
        $frequencies->everyMinute();

        $this->assertEquals($frequencies->expression, '* * * * *');
    }

    public function test_can_set_every_ten_minutes()
    {
        $frequencies = $this->getMockForTrait(Frequencies::class);
        $frequencies->expression = '* * * * *';
        $frequencies->everyTenMinutes();

        $this->assertEquals($frequencies->expression, '*/10 * * * *');
    }

    public function test_can_set_every_thirty_minutes()
    {
        $frequencies = $this->getMockForTrait(Frequencies::class);
        $frequencies->expression = '* * * * *';
        $frequencies->everyThirtyMinutes();

        $this->assertEquals($frequencies->expression, '*/30 * * * *');
    }
}
