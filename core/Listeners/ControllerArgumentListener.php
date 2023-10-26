<?php

namespace Core\Listeners;

use Core\Events\ControllerEvent;
use Core\Helpers\Cache;
use Core\Services\EventDispatcher\EventInterface;
use Core\Traits\DependencyInjection;

readonly class ControllerArgumentListener
{
    use DependencyInjection;

    /**
     * @param ControllerEvent $event
     */
    public function handle(EventInterface $event): void
    {
        $request = $event->request;
        Cache::save('request', $request);

        $handler = $request->getRoute()->getHandler();
        list($controller, $method) = [$handler[0], $handler[1] ?? '__invoke'];

        $event->setController($this->injectAndRetrieve($controller));
        $event->setMethod($method);
        $event->setArguments($this->getArguments($controller, $method));
    }
}
