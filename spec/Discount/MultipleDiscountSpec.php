<?php

namespace spec\Discount;

use Discount\PercentageBased;
use Discount\PriceBased;
use PhpSpec\ObjectBehavior;

class MultipleDiscountSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(4990);
    }

    function it_gets_its_name_as_array_from_its_children(PercentageBased $percentageBased, PriceBased $priceBased)
    {
        $percentageBased->getName()->willReturn('15% kedvezmény');
        $priceBased->getName()->willReturn('1500 Ft kedvezmény');

        $this->add($percentageBased);
        $this->add($priceBased);

        $this->getName()->shouldBe(['15% kedvezmény', '1500 Ft kedvezmény']);
    }

    function it_calculates_discount_data_from_its_children(PercentageBased $percentageBased, PriceBased $priceBased)
    {
        $percentageBased->appliedDiscount()->willReturn(499);
        $priceBased->appliedDiscount()->willReturn(1500);
        $percentageBased->appliedPercentage()->willReturn(10);
        $priceBased->appliedPercentage()->willReturn(30);
        $percentageBased->getName()->willReturn('10% kedvezmény');
        $priceBased->getName()->willReturn('1500 Ft kedvezmény');

        $this->add($percentageBased);
        $this->add($priceBased);

        $this->appliedDiscount()->shouldEqual(499 + 1500);
        $this->appliedPercentage()->shouldEqual(10 + 30);
        $this->discountedPrice()->shouldEqual(4990 - 499 - 1500);
        $this->getName()->shouldBe(['10% kedvezmény', '1500 Ft kedvezmény']);
    }
}
