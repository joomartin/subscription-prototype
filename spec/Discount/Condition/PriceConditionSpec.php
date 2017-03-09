<?php

namespace spec\Discount\Condition;

use PhpSpec\ObjectBehavior;
use Contract\User;

class PriceConditionSpec extends ObjectBehavior
{
    function it_satisfies_when_user_spent_exactly_the_required_money(User $user)
    {
        $user->spentMoney()->willReturn(10000);
        $this->beConstructedWith($user, 10000);

        $this->isSatisfied()->shouldBe(true);
    }

    function it_not_satisfies_when_user_spent_less_then_the_required_money(User $user)
    {
        $user->spentMoney()->willReturn(8900);
        $this->beConstructedWith($user, 9000);

        $this->isSatisfied()->shouldBe(false);
    }

    function it_not_satisfies_when_user_spent_more_then_the_required_money(User $user)
    {
        $user->spentMoney()->willReturn(15000);
        $this->beConstructedWith($user, 12500);

        $this->isSatisfied()->shouldBe(false);
    }
}
