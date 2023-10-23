<?php

namespace Core\Events;

use Core\Http\Request;
use Core\Listeners\RequestHttpMethodListener;
use Core\Listeners\RequestMiddlewareListener;
use Core\Listeners\RequestRouteListener;
use Core\Services\EventDispatcher\EventInterface;

class RequestEvent implements EventInterface
{
    public array $listeners = [
        RequestRouteListener::class,
        RequestHttpMethodListener::class,
        RequestMiddlewareListener::class,
    ];

    public function __construct(public Request $request)
    {
    }
}
