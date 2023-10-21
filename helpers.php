<?php

use Core\Helpers\Cache;

if (!function_exists('config')) {
    function config(string $name): array
    {
        $item = Cache::get('config.'.$name);
        if (null === $item) {
            $item = require sprintf('config/%s.php', $name);
            Cache::save('config.'.$name, $item);
        }

        return $item;
    }
}

if (!function_exists('tap')) {
    function tap(object $value, callable $callback): object
    {
        $callback($value);

        return $value;
    }
}
