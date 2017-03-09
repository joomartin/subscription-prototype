<?php

namespace Discount\Condition;

use Contract\User;

class PriceCondition extends Condition
{
    /**
     * @var float
     */
    private $price;

    /**
     * PriceCondition constructor.
     * @param User $user
     * @param float $price
     */
    public function __construct(User $user, $price)
    {
        parent::__construct($user);
        $this->price = $price;
    }

    /**
     * @return bool
     */
    public function isSatisfied()
    {
        return $this->user->spentMoney() % $this->price == 0;
    }
}
