<?php

namespace Tests\Integration\Subscription;

use Factory\Subscription\Subscription as SubscriptionFactory;
use PHPUnit_Framework_TestCase;
use User\UserMock;

class SubscriptionTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    function it_decorates_in_nested_level_with_percentage_based_repeating_discount()
    {
        $user = new UserMock([10, 10000]);
        $subscription = SubscriptionFactory::create('Premium', 9900, ['repeating' => 6, 'discount' => [['value' => 15, 'user' => $user]]]);

        $this->assertEquals(50490, $subscription->getPrice());
        $this->assertEquals('Premium, fél éves, 15% kedvezmény', $subscription->getName());
    }

    /** @test */
    function it_decorates_in_nested_level_with_price_based_repeating_discount()
    {
        $user = new UserMock([10, 10000]);
        $subscription = SubscriptionFactory::create('Standard', 4990, ['repeating' => 12, 'discount' => [['value' => 10000, 'user' => $user]]]);

        $this->assertEquals(49880, $subscription->getPrice());
        $this->assertEquals('Standard, éves, 16% kedvezmény', $subscription->getName());
    }

    /** @test */
    function it_decorates_in_nested_level_with_percentage_based_non_repeating_discount()
    {
        $user = new UserMock([10, 10000]);
        $subscription = SubscriptionFactory::create('Premium', 9900, ['discount' => [['value' => 15, 'user' => $user]]]);

        $this->assertEquals(8415, $subscription->getPrice());
        $this->assertEquals('Premium, 15% kedvezmény', $subscription->getName());
    }

    /** @test */
    function it_denies_discount_if_user_does_not_consumed_enough_quantity()
    {
        $user = new UserMock([4, 8]);

        $subscription = SubscriptionFactory::create('Premium', 9900, [
            'discount' => [[
                'value' => 15,
                'user' => $user,
                'conditions' => [['type' => 'QUANTITY', 'data' => 10]]
            ]]
        ]);

        $this->assertEquals(9900, $subscription->getPrice());
    }

    /** @test */
    function it_denies_discount_if_user_consumed_too_much_quantity()
    {
        $user = new UserMock([12, 8]);

        $subscription = SubscriptionFactory::create('Premium', 9900, [
            'discount' => [[
                'value' => 15,
                'user' => $user,
                'conditions' => [['type' => 'QUANTITY', 'data' => 10]]
            ]]
        ]);

        $this->assertEquals(9900, $subscription->getPrice());
    }

    /** @test */
    function it_allows_discount_if_user_consumed_just_enough_quantity()
    {
        $user = new UserMock([10, 8]);

        $subscription = SubscriptionFactory::create('Premium', 9900, [
            'discount' => [[
                'value' => 15,
                'user' => $user,
                'conditions' => [['type' => 'QUANTITY', 'data' => 10]]
            ]]
        ]);

        $this->assertEquals(8415, $subscription->getPrice());
    }

    /** @test */
    function it_allows_discount_if_user_consumed_multiple_quantity()
    {
        $user = new UserMock([20, 8]);

        $subscription = SubscriptionFactory::create('Premium', 9900, [
            'discount' => [[
                'value' => 15,
                'user' => $user,
                'conditions' => [['type' => 'QUANTITY', 'data' => 10]]
            ]]
        ]);

        $this->assertEquals(8415, $subscription->getPrice());
    }

    /** @test */
    function it_denies_discount_if_user_does_not_spent_enough_money()
    {
        $user = new UserMock([4, 7500]);

        $subscription = SubscriptionFactory::create('Premium', 9900, [
            'discount' => [[
                'value' => 15,
                'user' => $user,
                'conditions' => [['type' => 'PRICE', 'data' => 10000]]
            ]]
        ]);

        $this->assertEquals(9900, $subscription->getPrice());
    }

    /** @test */
    function it_denies_discount_if_user_spent_too_much_money()
    {
        $user = new UserMock([4, 12500]);

        $subscription = SubscriptionFactory::create('Premium', 9900, [
            'discount' => [[
                'value' => 15,
                'user' => $user,
                'conditions' => [['type' => 'PRICE', 'data' => 10000]]
            ]]
        ]);

        $this->assertEquals(9900, $subscription->getPrice());
    }

    /** @test */
    function it_allows_discount_if_user_spent_just_enough_money()
    {
        $user = new UserMock([4, 10000]);

        $subscription = SubscriptionFactory::create('Premium', 9000, [
            'discount' => [[
                'value' => 10,
                'user' => $user,
                'conditions' => [['type' => 'PRICE', 'data' => 10000]]
            ]]
        ]);

        $this->assertEquals(8100, $subscription->getPrice());
    }

    /** @test */
    function it_allows_discount_if_user_spent_multiple_money()
    {
        $user = new UserMock([4, 30000]);

        $subscription = SubscriptionFactory::create('Premium', 9000, [
            'discount' => [[
                'value' => 10,
                'user' => $user,
                'conditions' => [['type' => 'PRICE', 'data' => 10000]]
            ]]
        ]);

        $this->assertEquals(8100, $subscription->getPrice());
    }

    // @todo discount + condition + repeating
}