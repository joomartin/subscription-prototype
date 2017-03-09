<?php

namespace Composite;

trait Composite
{
    protected $items = [];

    /**
     * @param mixed $item
     * @return int
     */
    public function add($item)
    {
        $this->items[] = $item;
        return key(array_slice($this->items, -1, 1, true));
    }

    /**
     * @param mixed $item
     * @return int|bool
     */
    public function remove($item)
    {
        $index = array_search($item, $this->items);
        if ($index !== false) {
            unset($this->items[$index]);
        }

        return $index;
    }

    /**
     * @param int $index
     * @return mixed
     */
    public function get($index)
    {
        if (isset($this->items[$index])) {
            return $this->items[$index];
        }

        return null;
    }
}
