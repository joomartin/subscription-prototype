<?php

namespace Contract;

interface User
{
    /**
     * @return int
     */
    public function consumedQuantity();

    /**
     * @return float
     */
    public function spentMoney();
}