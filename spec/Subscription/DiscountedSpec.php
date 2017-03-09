<?php

namespace spec\Subscription;

use Contract\Subscription;
use PhpSpec\ObjectBehavior;
use Subscription\Repeating;
use Contract\User;

class DiscountedSpec extends ObjectBehavior
{
    function it_appends_discount_percentage_to_base_name_in_case_of_percentage_based_discount(Subscription $subscription, User $user)
    {
        $this->beConstructedWith($subscription, [['value' => 10, 'user' => $user]]);

        $subscription->getName()->willReturn('Standard');
        $subscription->getPrice()->willReturn(4990);

        $this->getName()->shouldReturn('Standard, 10% kedvezmény');
    }

    function it_appends_discount_percentage_to_base_name_in_case_of_price_based_discount(Subscription $subscription, User $user)
    {
        $this->beConstructedWith($subscription, [['value' => 5000, 'user' => $user]]);

        $subscription->getName()->willReturn('Premium');
        $subscription->getPrice()->willReturn(9900);

        $this->getName()->shouldReturn('Premium, 50% kedvezmény');
    }

    function it_calculates_discounted_price_in_case_of_percentage_based_discount(Subscription $subscription, User $user)
    {
        $this->beConstructedWith($subscription, [['value' => 30, 'user' => $user]]);

        $subscription->getName()->willReturn('Premium');
        $subscription->getPrice()->willReturn(10000);

        $this->getPrice()->shouldReturn(7000);
    }

    function it_calculates_discounted_price_in_case_of_price_based_discount(Subscription $subscription, User $user)
    {
        $this->beConstructedWith($subscription, [['value' => 5000, 'user' => $user]]);

        $subscription->getName()->willReturn('Premium');
        $subscription->getPrice()->willReturn(9900);

        $this->getPrice()->shouldReturn(4900);
    }

    function it_decorates_in_nested_level_with_percentage_based_repeating_discount(User $user)
    {
        $subscription = new \Subscription\Subscription('Premium', 9900);
        $repeating = new Repeating($subscription, 6);

        $this->beConstructedWith($repeating, [['value' => 15, 'user' => $user]]);

        $this->getPrice()->shouldEqual(50490);
        $this->getName()->shouldBe('Premium, fél éves, 15% kedvezmény');
    }

    function it_decorates_in_nested_level_with_price_based_repeating_discount(User $user)
    {
        $subscription = new \Subscription\Subscription('Premium', 9900);
        $repeating = new Repeating($subscription, 6);

        $this->beConstructedWith($repeating, [['value' => 5000, 'user' => $user]]);

        $this->getPrice()->shouldEqual(54400);
        $this->getName()->shouldBe('Premium, fél éves, 8% kedvezmény');
    }
}
