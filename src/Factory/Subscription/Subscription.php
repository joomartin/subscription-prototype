<?php

namespace Factory\Subscription;

use Subscription\Discounted;
use Subscription\Repeating;
use Subscription\Subscription as SubscriptionBase;

class Subscription
{
    /**
     * @param string $name
     * @param float $price
     * @param array $decoratorData
     * @return SubscriptionBase
     */
    public static function create($name, $price, array $decoratorData = [])
    {
        $subscription = new SubscriptionBase($name, $price);

        $repeating = (isset($decoratorData['repeating'])) ? $decoratorData['repeating'] : null;
        $discount = (isset($decoratorData['discount'])) ? $decoratorData['discount'] : null;

        if (!$discount && !$repeating) {
            return $subscription;
        }

        if ($discount && !$repeating) {
            return new Discounted($subscription, $discount);
        }

        if ($repeating && !$discount) {
            return new Repeating($subscription, $repeating);
        }

        return new Discounted(new Repeating($subscription, $repeating), $discount);
    }
}