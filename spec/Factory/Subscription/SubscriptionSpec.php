<?php

namespace spec\Factory\Subscription;

use PhpSpec\ObjectBehavior;
use Subscription\Discounted;
use Subscription\Repeating;
use Subscription\Subscription;
use Contract\User;

class SubscriptionSpec extends ObjectBehavior
{
    function it_creates_simple_subscription()
    {
        self::create('Premium', 9900)->shouldBeAnInstanceOf(Subscription::class);
    }

    function it_creates_discounted_subscription(User $user)
    {
        self::create('Premium', 9900, ['discount' => [['value' => 10, 'user' => $user]]])->shouldBeAnInstanceOf(Discounted::class);
        self::create('Premium', 9900, ['discount' => [['value' => 10, 'user' => $user]]])->getName()->shouldBe('Premium, 10% kedvezmény');
        self::create('Premium', 9900, ['discount' => [['value' => 10, 'user' => $user]]])->getPrice()->shouldEqual(8910);
    }

    function it_creates_repeating_subscription()
    {
        self::create('Premium', 9900, ['repeating' => 1])->shouldBeAnInstanceOf(Repeating::class);
        self::create('Premium', 9900, ['repeating' => 1])->getName()->shouldBe('Premium, havi');
        self::create('Premium', 9900, ['repeating' => 1])->getPrice()->shouldBe(9900);
    }

    function it_creates_discounted_repeating_subscription(User $user)
    {
        self::create('Premium', 9900, ['repeating' => 6, 'discount' => [['value' => 10, 'user' => $user]]])->shouldBeAnInstanceOf(Discounted::class);
        self::create('Premium', 9900, ['repeating' => 6, 'discount' => [['value' => 10, 'user' => $user]]])->getName()->shouldBe('Premium, fél éves, 10% kedvezmény');
    }
}
