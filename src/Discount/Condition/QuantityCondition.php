<?php

namespace Discount\Condition;

use Contract\User;

class QuantityCondition extends Condition
{
    /**
     * @var float
     */
    private $quantity;

    /**
     * QuantityCondition constructor.
     * @param User $user
     * @param float $quantity
     */
    public function __construct(User $user, $quantity)
    {
        parent::__construct($user);
        $this->quantity = $quantity;
    }

    /**
     * @return bool
     */
    public function isSatisfied()
    {
        return $this->user->consumedQuantity() % $this->quantity == 0;
    }
}
