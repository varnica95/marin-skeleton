<?php

namespace Core\Listeners;

use Core\Events\RequestEvent;
use Core\Services\EventDispatcher\EventInterface;

readonly class CheckCurrentMethodListener
{
    /**
     * @param RequestEvent $event
     */
    public function handle(EventInterface $event): void
    {
        $route = $event->request->getRoute();
        $method = $event->request->server->get('REQUEST_METHOD');

        if (!in_array($method, $route->getMethods())) {
            throw new \RuntimeException('Wrong method.');
        }
    }
}
