<?php

namespace Core\Helpers;

class Cache
{
    private static array $items = [];

    public static function save(string $key, mixed $value): void
    {
        self::$items[$key] = $value;
    }

    public static function get(string $key): mixed
    {
        return self::$items[$key] ?? null;
    }
}
