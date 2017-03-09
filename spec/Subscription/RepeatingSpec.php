<?php

namespace spec\Subscription;

use Contract\Subscription;
use PhpSpec\ObjectBehavior;

class RepeatingSpec extends ObjectBehavior
{
    function it_append_monthly_period_name_to_base_name(Subscription $subscription)
    {
        $this->beConstructedWith($subscription, 1);
        $subscription->getName()->willReturn('Standard');
        $this->getName()->shouldReturn('Standard, havi');
    }

    function it_append_quarterly_period_name_to_base_name(Subscription $subscription)
    {
        $this->beConstructedWith($subscription, 3);
        $subscription->getName()->willReturn('Standard');
        $this->getName()->shouldReturn('Standard, negyed éves');
    }

    function it_append_half_yearly_period_name_to_base_name(Subscription $subscription)
    {
        $this->beConstructedWith($subscription, 6);
        $subscription->getName()->willReturn('Standard');
        $this->getName()->shouldReturn('Standard, fél éves');
    }

    function it_append_yearly_period_name_to_base_name(Subscription $subscription)
    {
        $this->beConstructedWith($subscription, 12);
        $subscription->getName()->willReturn('Standard');
        $this->getName()->shouldReturn('Standard, éves');
    }

    function it_not_multiplies_price_in_monthly_period(Subscription $subscription)
    {
        $this->beConstructedWith($subscription, 1);
        $subscription->getPrice()->willReturn(4990);
        $this->getPrice()->shouldReturn(4990);
    }

    function it_multiplies_price_in_quarterly_period(Subscription $subscription)
    {
        $this->beConstructedWith($subscription, 3);
        $subscription->getPrice()->willReturn(4990);
        $this->getPrice()->shouldReturn(4990 * 3);
    }

    function it_multiplies_price_in_half_yearly_period(Subscription $subscription)
    {
        $this->beConstructedWith($subscription, 6);
        $subscription->getPrice()->willReturn(4990);
        $this->getPrice()->shouldReturn(4990 * 6);
    }

    function it_multiplies_price_in_yearly_period(Subscription $subscription)
    {
        $this->beConstructedWith($subscription, 12);
        $subscription->getPrice()->willReturn(4990);
        $this->getPrice()->shouldReturn(4990 * 12);
    }

}
