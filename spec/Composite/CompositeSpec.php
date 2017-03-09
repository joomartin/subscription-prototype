<?php

namespace spec\Composite;

use Composite\CompositeStub;
use Discount\PercentageBased;
use Discount\PriceBased;
use PhpSpec\ObjectBehavior;

class CompositeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf(CompositeStub::class);
    }

    function it_can_add_new_children()
    {
        $percentageBased = new PercentageBased(4990, 15);
        $priceBased = new PriceBased(4990, 1500);

        $this->add($percentageBased)->shouldEqual(0);
        $this->add($priceBased)->shouldEqual(1);
    }

    function it_can_remove_its_children()
    {
        $percentageBased = new PercentageBased(4990, 15);
        $priceBased = new PriceBased(4990, 1500);

        $this->add($percentageBased);
        $this->add($priceBased);

        $this->remove($percentageBased)->shouldEqual(0);
        $this->remove($priceBased)->shouldEqual(1);

        $this->remove($percentageBased)->shouldBe(false);
    }

    function it_can_get_its_children()
    {
        $percentageBased = new PercentageBased(4990, 15);
        $priceBased = new PriceBased(4990, 1500);

        $this->add($percentageBased);
        $this->add($priceBased);

        $this->get(0)->shouldBe($percentageBased);
        $this->get(1)->shouldBe($priceBased);

        $this->get(2)->shouldBe(null);
    }
}
