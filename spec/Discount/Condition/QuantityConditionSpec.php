<?php

namespace spec\Discount\Condition;

use PhpSpec\ObjectBehavior;
use Contract\User;

class QuantityConditionSpec extends ObjectBehavior
{
    function it_satisfies_when_user_consumed_exactly_the_required_quantity(User $user)
    {
        $user->consumedQuantity()->willReturn(10);
        $this->beConstructedWith($user, 10);

        $this->isSatisfied()->shouldBe(true);
    }

    function it_not_satisfies_when_user_consumed_lower_then_the_required_quantity(User $user)
    {
        $user->consumedQuantity()->willReturn(8);
        $this->beConstructedWith($user, 10);

        $this->isSatisfied()->shouldBe(false);
    }

    function it_not_satisfies_when_user_consumed_more_then_the_required_quantity(User $user)
    {
        $user->consumedQuantity()->willReturn(15);
        $this->beConstructedWith($user, 10);

        $this->isSatisfied()->shouldBe(false);
    }
}
