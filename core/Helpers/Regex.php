<?php

namespace Core\Helpers;

class Regex
{
    public static function variables(string $expression, string $subject): array
    {
        /** @var string $expression */
        $expression = preg_replace('/\//', '\\/', $expression);
        $pattern = '/^'.preg_replace('/{([a-z]+)}/i', '(?P<\1>[^\.]+)', $expression).'/';

        preg_match($pattern, $subject, $matched);

        return array_filter($matched, fn ($variable) => !is_numeric($variable) || 0 === $variable, ARRAY_FILTER_USE_KEY);
    }
}
