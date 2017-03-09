<?php

namespace User;

use Contract\User;

class UserMock implements User
{
    private $consumedQuantity = 0;

    private $spentMoney = 0;

    public function __construct(array $data = null)
    {
        if ($data) {
            $this->consumedQuantity = $data[0];
            $this->spentMoney = $data[1];
        }
    }
    /**
     * @return int
     */
    public function consumedQuantity()
    {
        return $this->consumedQuantity;
    }

    /**
     * @return float
     */
    public function spentMoney()
    {
        return $this->spentMoney;
    }
}