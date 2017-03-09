<?php

namespace spec\Discount\Condition;

use Discount\Condition\PriceCondition;
use Discount\Condition\QuantityCondition;
use PhpSpec\ObjectBehavior;

class MultipleConditionSpec extends ObjectBehavior
{
    function it_satisfies_when_all_child_conditions_satisfied(PriceCondition $priceCondition, QuantityCondition $quantityCondition)
    {
        $priceCondition->isSatisfied()->willReturn(true);
        $quantityCondition->isSatisfied()->willReturn(true);

        $this->add($priceCondition);
        $this->add($quantityCondition);

        $this->isSatisfied()->shouldBe(true);
    }

    function it_does_not_satisfies_when_one_of_its_child_condition_does_not_satisfied(PriceCondition $priceCondition, QuantityCondition $quantityCondition)
    {
        $priceCondition->isSatisfied()->willReturn(false);
        $quantityCondition->isSatisfied()->willReturn(true);

        $this->add($priceCondition);
        $this->add($quantityCondition);

        $this->isSatisfied()->shouldBe(false);
    }
}
