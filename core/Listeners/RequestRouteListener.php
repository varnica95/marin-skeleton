<?php

namespace Core\Listeners;

use Core\Events\RequestEvent;
use Core\Helpers\Regex;
use Core\Http\Route;
use Core\Services\EventDispatcher\EventInterface;

readonly class RequestRouteListener
{
    /**
     * @param RequestEvent $event
     */
    public function handle(EventInterface $event): void
    {
        $requestUri = $event->request->server->get('REQUEST_URI', '/');

        foreach (config('routes') as $uri => $data) {
            $variables = Regex::variables($uri, $requestUri);
            if ([] === $variables) {
                continue;
            }

            // unset matched path
            unset($variables[0]);

            $route = new Route();
            $route->setUri($uri);
            $route->setMethods($data['methods'] ?? ['GET']);
            $route->setMiddlewares($data['middlewares'] ?? []);
            $route->setHandler($data['handler']);
            $route->setVariables($variables);

            $event->request->setRoute($route);

            return;
        }

        throw new \RuntimeException('The route is missing.');
    }
}
