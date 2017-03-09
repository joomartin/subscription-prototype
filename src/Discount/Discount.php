<?php

namespace Discount;

use Discount\Condition\Condition;
use Factory\Discount\Condition as ConditionFactory;

abstract class Discount
{
    /**
     * @var float
     */
    protected $basePrice;

    /**
     * @var Condition
     */
    protected $condition;

    /**
     * @var bool
     */
    protected $isApplied = false;

    /**
     * Discount constructor.
     * @param float $basePrice
     */
    public function __construct($basePrice)
    {
        $this->basePrice = $basePrice;
        $this->condition = ConditionFactory::create();
    }

    /**
     * @param Condition $condition
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;
    }

    public function isApplied()
    {
        return $this->isApplied;
    }

    /**
     * @return float
     */
    public function discountedPrice()
    {
        return call_user_func([$this, 'applyCondition'], 'calculateDiscountedPrice', $this->basePrice);
    }

    /**
     * @return float
     */
    public function appliedDiscount()
    {
        return call_user_func([$this, 'applyCondition'], 'calculateAppliedDiscount');
    }

    /**
     * @return float
     */
    public function appliedPercentage()
    {
        return call_user_func([$this, 'applyCondition'], 'calculateAppliedPercentage');
    }

    public function getAppliedDiscount()
    {
        if ($this->isApplied) {
            return [$this];
        }

        return null;
    }

    /**
     * @param string $callback
     * @param int $default
     * @return int
     */
    protected function applyCondition($callback, $default = 0)
    {
        if ($this->condition->isSatisfied()) {
            $this->isApplied = true;
            return $this->{$callback}();
        }

        return $default;
    }

    /**
     * @return array
     */
    abstract public function getName();

    /**
     * @return float
     */
    abstract protected function calculateAppliedPercentage();

    /**
     * @return float
     */
    abstract protected function calculateAppliedDiscount();

    /**
     * @return float
     */
    abstract protected function calculateDiscountedPrice();
}