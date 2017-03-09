<?php

namespace Discount;

use Composite\Composite;

class MultipleDiscount extends Discount
{
    use Composite;

    /**
     * @return array
     */
    public function getName()
    {
        $names = [];
        foreach ($this->items as $discount) {
            $names[] = $discount->getName();
        }

        return $names;
    }

    public function getAppliedDiscount()
    {
        $discounts = [];
        foreach ($this->items as $item) {
            /**
             * @var Discount $item
             */
            if ($item->getAppliedDiscount()) {
                $discounts[] = $item;
            }
        }

        return $discounts;
    }

    /**
     * @return float
     */
    protected function calculateAppliedPercentage()
    {
        $percentageSum = 0;
        foreach ($this->items as $discount) {
            $percentageSum += $discount->appliedPercentage();
        }

        return $percentageSum;
    }

    /**
     * @return float
     */
    protected function calculateAppliedDiscount()
    {
        $discountSum = 0;
        foreach ($this->items as $discount) {
            $discountSum += $discount->appliedDiscount();
        }

        return $discountSum;
    }

    /**
     * @return float
     */
    protected function calculateDiscountedPrice()
    {
        $discountSum = 0;
        foreach ($this->items as $discount) {
            $discountSum += $discount->appliedDiscount();
        }

        return $this->basePrice - $discountSum;
    }
}