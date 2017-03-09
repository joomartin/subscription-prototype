<?php

namespace spec\Helper;

use PhpSpec\ObjectBehavior;

class PeriodSpec extends ObjectBehavior
{
    function it_converts_special_period_numbers_to_its_name()
    {
        self::convert(1)->shouldBe('havi');
        self::convert(3)->shouldBe('negyed éves');
        self::convert(6)->shouldBe('fél éves');
        self::convert(12)->shouldBe('éves');
    }
}
