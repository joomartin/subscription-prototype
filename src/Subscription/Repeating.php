<?php

namespace Subscription;

use Contract\Subscription as SubscriptionContract;
use Helper\Period;

class Repeating implements SubscriptionContract
{
    /**
     * @var SubscriptionContract
     */
    private $subscription;

    /**
     * @var int
     */
    private $interval;

    /**
     * @param SubscriptionContract $subscription
     * @param int $interval
     */
    public function __construct(SubscriptionContract $subscription, $interval)
    {
        $this->subscription = $subscription;
        $this->interval = $interval;
    }

    /**
     * @return string
     */
    public function getName()
    {
        $period = Period::convert($this->interval);
        return $this->subscription->getName() . ", {$period}";
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->subscription->getPrice() * $this->interval;
    }
}
