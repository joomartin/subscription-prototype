<?php

namespace Factory\Discount;

use Discount\Discount as DiscountBase;
use Discount\MultipleDiscount;
use Discount\PercentageBased;
use Discount\PriceBased;
use InvalidArgumentException;

class Discount
{
    const PERCENTAGE = 'PERCENTAGE';
    const PRICE = 'PRICE';

    /**
     * @param float $basePrice
     * @param array $discountData
     * @return DiscountBase
     */
    public static function create($basePrice, array $discountData)
    {
        if (count($discountData) == 1) {
            return self::createOne($basePrice, $discountData[0]);
        }

        $multipleDiscount = new MultipleDiscount($basePrice);
        foreach ($discountData as $data) {
            $multipleDiscount->add(self::createOne($basePrice, $data));
        }

        return $multipleDiscount;
    }

    /**
     * @param float $basePrice
     * @param array $data
     * @return DiscountBase
     */
    public static function createOne($basePrice, array $data)
    {
        $value = $data['value'];
        $user = $data['user'];
        $conditions = (isset($data['conditions'])) ? $data['conditions'] : [];
        $discount = null;

        $type = self::getType($value);

        switch ($type) {
            case self::PERCENTAGE: $discount = new PercentageBased($basePrice, $value); break;
            case self::PRICE: $discount = new PriceBased($basePrice, $value); break;
        }

        if (!$discount) {
            throw new InvalidArgumentException("Cannot create discount with value: {$value}");
        }

        $condition = Condition::create($user, $conditions);
        $discount->setCondition($condition);

        return $discount;
    }

    /**
     * @param float $discountValue
     * @return string
     */
    protected static function getType($discountValue)
    {
        if (!is_numeric($discountValue)) {
            return null;
        }

        if ($discountValue <= 100) {
            return self::PERCENTAGE;
        }

        return self::PRICE;
    }
}
