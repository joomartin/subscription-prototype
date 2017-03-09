<?php

namespace spec\Factory\Discount;

use Discount\Condition\MultipleCondition;
use Discount\Condition\NoCondition;
use Discount\Condition\PriceCondition;
use Discount\Condition\QuantityCondition;
use Discount\MultipleDiscount;
use PhpSpec\ObjectBehavior;
use Contract\User;

class ConditionSpec extends ObjectBehavior
{
    function it_creates_no_condition_if_no_data_given(User $user)
    {
        self::create($user, [])->shouldBeAnInstanceOf(NoCondition::class);
    }

    function it_creates_quantity_based_condition_by_given_data(User $user)
    {
        $user->consumedQuantity()->willReturn(3);
        $conditions = [
            ['type' => 'QUANTITY', 'data' => 3]
        ];

        self::create($user, $conditions)->shouldBeAnInstanceOf(QuantityCondition::class);
    }

    function it_creates_price_based_condition_by_given_data(User $user)
    {
        $user->spentMoney()->willReturn(3000);
        $conditions = [
            ['type' => 'PRICE', 'data' => 3000]
        ];

        self::create($user, $conditions)->shouldBeAnInstanceOf(PriceCondition::class);
    }

    function it_creates_multiple_condition_by_given_data(User $user)
    {
        $user->spentMoney()->willReturn(3000);
        $user->consumedQuantity()->willReturn(1);

        $conditions = [
            ['type' => 'PRICE', 'data' => 3000], ['type' => 'QUANTITY', 'data' => 1]
        ];

        self::create($user, $conditions)->shouldBeAnInstanceOf(MultipleCondition::class);
    }

    function it_creates_no_condition_if_type_not_given(User $user)
    {
        self::create($user)->shouldBeAnInstanceOf(NoCondition::class);
    }
}
