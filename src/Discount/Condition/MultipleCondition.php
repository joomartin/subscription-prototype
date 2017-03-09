<?php

namespace Discount\Condition;

use Composite\Composite;

class MultipleCondition extends Condition
{
    use Composite;

    /**
     * @return bool
     */
    public function isSatisfied()
    {
        $isSatisfied = true;
        foreach ($this->items as $condition) {
            $isSatisfied = $isSatisfied && $condition->isSatisfied();
        }

        return $isSatisfied;
    }
}