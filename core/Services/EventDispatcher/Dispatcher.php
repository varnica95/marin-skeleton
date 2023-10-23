<?php

namespace Core\Services\EventDispatcher;

use Core\Traits\DependencyInjection;

class Dispatcher
{
    use DependencyInjection;

    protected array $listeners = [];

    public function addListeners(string $event, array $listeners): void
    {
        $this->listeners[$event] = array_merge($this->listeners[$event] ?? [], $listeners);
    }

    public function dispatch(EventInterface $event): EventInterface
    {
        $name = get_class($event);
        $this->addListeners($name, $event->listeners ?? []);
        foreach ($this->listeners[$name] ?? [] as $listener) {
            /** @var ListenerInterface $instance */
            $instance = $this->injectAndRetrieve($listener);
            $instance->handle($event);
        }

        return $event;
    }
}
