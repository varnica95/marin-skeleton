<?php

namespace Core;

use Core\Traits\DependencyInjection;

class Container
{
    use DependencyInjection;

    private array $services = [];

    public function __construct()
    {
        foreach (config('services') as $service) {
            $this->services[$service] = $service;
        }
    }

    public function get(string $key): object
    {
        return $this->injectAndRetrieve($this->services[$key]);
    }

    public function inject(string $name): object
    {
        return $this->injectAndRetrieve($name);
    }
}
