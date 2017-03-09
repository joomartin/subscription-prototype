<?php

namespace spec\Discount;

use PhpSpec\ObjectBehavior;

class PriceBasedSpec extends ObjectBehavior
{    function it_calculates_integer_discount_rate_in_percentage()
    {
        $this->beConstructedWith(4990, 499);
        $this->appliedPercentage()->shouldEqual(10);
    }

    function it_calculates_rounded_discount_rate_in_percentage()
    {
        $this->beConstructedWith(4990, 750);
        $this->appliedPercentage()->shouldEqual(15);
    }

    function it_calculates_discounted_price_by_lower_discount_then_price()
    {
        $this->beConstructedWith(4990, 500);
        $this->discountedPrice()->shouldEqual(4490);
    }

    function it_calculates_discounted_price_by_equal_discount_to_price()
    {
        $this->beConstructedWith(4990, 4990);
        $this->discountedPrice()->shouldEqual(0);
    }

    function it_calculates_discounted_price_as_zero_when_discount_higher_then_price()
    {
        $this->beConstructedWith(4990, 10000);
        $this->discountedPrice()->shouldEqual(0);
    }

    function it_calculates_discount_as_discount_by_lower_discount_then_price()
    {
        $this->beConstructedWith(4990, 500);
        $this->appliedDiscount()->shouldEqual(500);
    }

    function it_calculates_discount_as_discount_by_equal_discount_to_price()
    {
        $this->beConstructedWith(4990, 4990);
        $this->appliedDiscount()->shouldEqual(4990);
    }

    function it_calculates_discount_as_price_when_discount_higher_then_price()
    {
        $this->beConstructedWith(4990, 10000);
        $this->appliedDiscount()->shouldEqual(4990);
    }

    function it_gets_its_name()
    {
        $this->beConstructedWith(4990, 1500);
        $this->getName()->shouldBe('1500 Ft kedvezmény');
    }
}
