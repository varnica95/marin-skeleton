<?php

namespace Core;

use Core\Events\ControllerEvent;
use Core\Events\RequestEvent;
use Core\Http\Request;
use Core\Providers\AppProvider;
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
        foreach ([AppProvider::class, ...AppProvider::$providers] as $provider) {
            tap($this->container->inject($provider), fn ($object) => $object->boot());
        }
    }

    public function handle(Request $request): void
    {
        /** @var Dispatcher $dispatcher */
        $dispatcher = $this->getService(Dispatcher::class);

        // dispatch request
        $dispatcher->dispatch(new RequestEvent($request));

        // dispatch controller
        $controllerEvent = new ControllerEvent($request);
        $dispatcher->dispatch($controllerEvent);

        // run the controller
        $controller = $controllerEvent->getController();
        $method = $controllerEvent->getMethod();
        $arguments = $controllerEvent->getArguments();

        $response = $controller->$method(...$arguments);
    }
}
