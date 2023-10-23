<?php

namespace Core\Listeners;

use Core\Events\RequestEvent;
use Core\Http\Middleware\Middleware;
use Core\Services\EventDispatcher\EventInterface;

readonly class RequestMiddlewareListener
{
    public function __construct(
        private Middleware $middleware
    ) {
    }

    /**
     * @param RequestEvent $event
     */
    public function handle(EventInterface $event): void
    {
        $middlewares = $event->request->getRoute()->getMiddlewares();

        foreach ($middlewares as $middleware) {
            tap(new $middleware(), fn ($middleware) => $this->middleware->add($middleware));
        }

        $this->middleware->handle($event->request);
    }
}
