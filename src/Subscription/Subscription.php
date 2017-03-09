<?php

namespace Subscription;

use Contract\Subscription as SubscriptionContract;

class Subscription implements SubscriptionContract
{
    /**
     * @var
     */
    private $name;
    /**
     * @var
     */
    private $price;

    /**
     * Subscription constructor.
     * @param string $name
     * @param float $price
     */
    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }
}