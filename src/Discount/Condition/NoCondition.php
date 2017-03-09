<?php

namespace Discount\Condition;

class NoCondition extends Condition
{
    /**
     * @return bool
     */
    public function isSatisfied()
    {
        return true;
    }
}
