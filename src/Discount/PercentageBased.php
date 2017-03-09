<?php

namespace Discount;

class PercentageBased extends Discount
{
    /**
     * @var float
     */
    private $percentage;

    /**
     * @param float $basePrice
     * @param float $percentage
     */
    public function __construct($basePrice, $percentage)
    {
        parent::__construct($basePrice);
        $this->percentage = $percentage;
    }

    /**
     * @return array
     */
    public function getName()
    {
        return "{$this->percentage}% kedvezmény";
    }

    /**
     * @return float
     */
    protected function calculateAppliedPercentage()
    {
        if ($this->condition->isSatisfied()) {
            return $this->percentage;
        }

        return 0;
    }

    /**
     * @return float
     */
    protected function calculateAppliedDiscount()
    {
        if ($this->condition->isSatisfied()) {
            return intval($this->basePrice * ($this->percentage / 100));
        }

        return 0;
    }

    /**
     * @return float
     */
    protected function calculateDiscountedPrice()
    {
        return intval($this->basePrice - ($this->basePrice * ($this->percentage / 100)));
    }


}
