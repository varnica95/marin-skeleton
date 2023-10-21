<?php

namespace Core\Helpers;

use ReflectionNamedType;

class Reflection
{
    public static function getParameters(string $class, string $method): array
    {
        try {
            return (new \ReflectionMethod($class, $method))->getParameters();
        } catch (\ReflectionException $exception) {
            return [];
        }
    }

    public static function getTypeName(\ReflectionParameter $parameter): string
    {
        /** @var ReflectionNamedType $type */
        $type = $parameter->getType();

        return $type->getName();
    }
}
