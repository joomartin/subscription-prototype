<?php

namespace Subscription;

use Contract\Subscription as SubscriptionContract;
use Discount\Discount;
use Factory\Discount\Discount as DiscountFactory;

class Discounted implements SubscriptionContract
{
    /**
     * @var SubscriptionContract
     */
    private $subscription;

    /**
     * @var Discount
     */
    private $discount;

    /**
     * @param SubscriptionContract $subscription
     * @param array $discountData
     */
    public function __construct(SubscriptionContract $subscription, array $discountData)
    {
        $this->subscription = $subscription;
        $this->discount = DiscountFactory::create($this->subscription->getPrice(), $discountData);
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @return Discount[]
     */
    public function getAppliedDiscounts()
    {
        return $this->discount->getAppliedDiscount();
    }

    /**
     * @param Discount $discount
     */
    public function setDiscount(Discount $discount)
    {
        $this->discount = $discount;
    }

    public function getName()
    {
        return $this->subscription->getName() . ", {$this->discount->appliedPercentage()}% kedvezmény";
    }

    public function getPrice()
    {
        return intval($this->discount->discountedPrice());
    }
}
