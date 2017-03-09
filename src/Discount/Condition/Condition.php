<?php

namespace Discount\Condition;

use Contract\User;

abstract class Condition
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @param User $user
     */
    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    /**
     * @return bool
     */
    abstract public function isSatisfied();
}
