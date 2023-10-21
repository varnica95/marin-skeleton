<?php

namespace Core\Traits;

use Core\Helpers\Cache;
use Core\Helpers\Reflection;
use ReflectionParameter;

trait DependencyInjection
{
    private function getArguments(string $class, string $method = '__construct'): array
    {
        $arguments = [];

        /** @var ReflectionParameter $parameter */
        foreach (Reflection::getParameters($class, $method) as $parameter) {
            $arguments[] = $this->injectAndRetrieve(Reflection::getTypeName($parameter));
        }

        return $arguments;
    }

    private function injectAndRetrieve(string $name, string $method = '__construct'): object
    {
        /* @phpstan-ignore-next-line */
        return Cache::get($name) ??
            tap(new $name(...$this->getArguments($name, $method)), function ($object) use ($name) {
                Cache::save($name, $object);
            });
    }
}
