<?php

class Collection
{
    protected $items = [];

    public function __construct($items=[])
    {
        $this->items = $items;
    }

    public function all()
    {
        return $this->items;
    }

    public function push($item)
    {
        $this->items[] = $item;
        return $this;
    }

    public function add($item)
    {
        $this->items[] = $item;
        return $this;
    }

    public function filter($callback)
    {
        return new static(array_filter($this->items,$callback));
    }

    public function map($callback)
    {
        return new static(array_map($callback,$this->items));
    }

    public function first()
    {
        return $this->items[0] ?? null;
    }

    public function last()
    {
        return end($this->items);
    }

    public function pluck($key)
    {
        return new static(array_map(fn($i)=>$i->$key,$this->items));
    }

    public function sortBy($callback)
    {
        $items=$this->items;
        usort($items,$callback);
        return new static($items);
    }
}
