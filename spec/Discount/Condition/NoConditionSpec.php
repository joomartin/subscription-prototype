<?php

namespace spec\Discount\Condition;

use PhpSpec\ObjectBehavior;
use Contract\User;

class NoConditionSpec extends ObjectBehavior
{
    function let(User $user)
    {
        $this->beConstructedWith($user);
    }

    function it_always_satisfies(User $user)
    {
        $user->consumedQuantity()->shouldNotBeCalled();
        $user->spentMoney()->shouldNotBeCalled();

        $this->isSatisfied()->shouldBe(true);
    }
}
