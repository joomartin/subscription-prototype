<?php

use Discount\Condition\MultipleCondition;
use Discount\Condition\PriceCondition;
use Discount\Condition\QuantityCondition;
use User\UserMock;

require 'vendor/autoload.php';

$user = new UserMock([10, 10000]);

/**
 * @var \Subscription\Discounted $subscription
 */
//$subscription = \Factory\Subscription\Subscription::create('Premium', 9900, ['discount' => [['value' => 10, 'user' => $user], ['value' => 1500, 'user' => $user]]]);
$subscription = \Factory\Subscription\Subscription::create('Premium', 9900, ['discount' => [['value' => 10, 'user' => $user]]]);

$subscription->getPrice();
var_dump($subscription->getAppliedDiscounts());