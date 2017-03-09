<?php

namespace Discount;

class PriceBased extends Discount
{
    /**
     * @var float
     */
    private $discountPrice;

    /**
     * @param float $basePrice
     * @param float $discountPrice
     */
    public function __construct($basePrice, $discountPrice)
    {
        parent::__construct($basePrice);
        $this->discountPrice = $discountPrice;
    }

    /**
     * @return array
     */
    public function getName()
    {
        return "{$this->discountPrice} Ft kedvezmény";
    }

    /**
     * @return float
     */
    protected function calculateAppliedPercentage()
    {
        if ($this->condition->isSatisfied()) {
            return intval(($this->discountPrice / $this->basePrice) * 100);
        }

        return 0;
    }

    /**
     * @return float
     */
    protected function calculateAppliedDiscount()
    {
        if ($this->condition->isSatisfied()) {
            return min($this->basePrice, $this->discountPrice);
        }

        return 0;
    }

    /**
     * @return float
     */
    protected function calculateDiscountedPrice()
    {
        $min = min($this->basePrice, $this->discountPrice);
        return $this->basePrice - $min;
    }

}
