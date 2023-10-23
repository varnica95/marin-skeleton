<?php

namespace Core\Http\Bags;

abstract class Bag
{
    private array $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function get(string $key, string $default = null): string
    {
        return $this->items[$key] ?? $default;
    }

    public function all(): array
    {
        return $this->items;
    }
}
