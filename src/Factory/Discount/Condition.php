<?php

namespace Factory\Discount;

use Discount\Condition\Condition as ConditionBase;
use Discount\Condition\MultipleCondition;
use Discount\Condition\NoCondition;
use Discount\Condition\PriceCondition;
use Discount\Condition\QuantityCondition;
use Contract\User;

class Condition
{
    const QUANTITY = 'QUANTITY';
    const PRICE = 'PRICE';

    /**
     * @param User $user
     * @param array $conditions
     * @return ConditionBase
     */
    public static function create(User $user = null, array $conditions = [])
    {
        if (empty($conditions)) {
            return new NoCondition;
        }

        if (count($conditions) == 1) {
            return self::createOne($user, $conditions[0]['type'], $conditions[0]['data']);
        }

        $multipleCondition = new MultipleCondition;
        foreach ($conditions as $conditionItem) {
            $condition = self::createOne($user, $conditionItem['type'], $conditionItem['data']);
            $multipleCondition->add($condition);
        }

        return $multipleCondition;
    }

    /**
     * @param User $user
     * @param string|null $type
     * @param mixed|null $data
     * @return ConditionBase
     */
    protected static function createOne(User $user = null, $type = null, $data = null)
    {
        switch ($type) {
            case self::QUANTITY: return new QuantityCondition($user, $data);
            case self::PRICE: return new PriceCondition($user, $data);
        }

        return new NoCondition();
    }
}
