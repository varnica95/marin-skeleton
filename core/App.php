<?php

namespace Core;

use Core\Services\Contracts\ProviderInterface;
use Core\Services\EventDispatcher\Dispatcher;

readonly class App
{
    private Container $container;

    public function __construct()
    {
        $this->container = new Container();

        // register all providers
        $this->bootProviders();
    }

    private function getService(string $key): object
    {
        return $this->container->get($key);
    }

    private function bootProviders(): void
    {
        foreach (config('providers') as $provider) {
            /** @var ProviderInterface $object */
            $object = $this->container->inject($provider);
            $object->boot();
        }
    }

    public function run(): void
    {
        /** @var Dispatcher $dispatcher */
        $dispatcher = $this->getService(Dispatcher::class);
    }
}
