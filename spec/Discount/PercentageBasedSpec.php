<?php

namespace spec\Discount;

use PhpSpec\ObjectBehavior;

class PercentageBasedSpec extends ObjectBehavior
{
    function it_calculates_integer_discount_rate_in_percentage()
    {
        $this->beConstructedWith(4990, 10);
        $this->appliedPercentage()->shouldEqual(10);
    }

    function it_calculates_float_discount_rate_in_percentage()
    {
        $this->beConstructedWith(4990, 12.5);
        $this->appliedPercentage()->shouldEqual(12.5);
    }

    function it_calculates_discounted_price_by_integer_percentage()
    {
        $this->beConstructedWith(4990, 10);
        $this->discountedPrice()->shouldEqual(4491);
    }

    function it_calculates_discounted_price_by_float_percentage()
    {
        $this->beConstructedWith(4990, 12.5);
        $this->discountedPrice()->shouldEqual(4366);
    }

    function it_calculates_discount_by_integer_percentage()
    {
        $this->beConstructedWith(4990, 10);
        $this->appliedDiscount()->shouldEqual(499);
    }

    function it_calculates_discount_by_float_percentage()
    {
        $this->beConstructedWith(4990, 12.5);
        $this->appliedDiscount()->shouldEqual(623);
    }

    function it_gets_its_name()
    {
        $this->beConstructedWith(4990, 12.5);
        $this->getName()->shouldBe('12.5% kedvezmény');
    }
}
