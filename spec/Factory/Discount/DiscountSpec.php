<?php

namespace spec\Factory\Discount;

use Discount\MultipleDiscount;
use Discount\PercentageBased;
use Discount\PriceBased;
use InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use Contract\User;

class DiscountSpec extends ObjectBehavior
{
    function it_creates_percentage_based_discount_by_given_data(User $user)
    {
        $data = [
            ['value' => 15, 'user' => $user]
        ];

        self::create(19900, $data)->shouldBeAnInstanceOf(PercentageBased::class);
    }

    function it_creates_price_based_discount_by_given_data(User $user)
    {
        $data = [
            ['value' => 1500, 'user' => $user]
        ];

        self::create(19900, $data)->shouldBeAnInstanceOf(PriceBased::class);
    }

    function it_creates_multiple_discount_by_given_data(User $user)
    {
        $data = [
            'discount' => [
                ['value' => 20, 'conditions' => [['type' => 'quantity', 'data' => 3]], 'user' => $user],
                ['value' => 1500, 'conditions' => [['type' => 'price', 'data' => 10000]], 'user' => $user],
            ]
        ];

        self::create(9900, $data['discount'])->shouldBeAnInstanceOf(MultipleDiscount::class);
    }

    function it_throws_an_exception_if_given_type_is_invalid(User $user)
    {
        $data = [
            ['value' => 'invalid', 'user' => $user]
        ];

        $this->shouldThrow(
            new InvalidArgumentException('Cannot create discount with value: invalid'
        ))->duringCreate(14900, $data);
    }
}
