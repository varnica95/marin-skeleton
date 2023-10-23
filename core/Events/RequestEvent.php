<?php

namespace Core\Events;

use Core\Http\Request;
use Core\Listeners\CheckCurrentMethodListener;
use Core\Listeners\FindCurrentRouteListener;
use Core\Services\EventDispatcher\EventInterface;

class RequestEvent implements EventInterface
{
    public array $listeners = [
        FindCurrentRouteListener::class,
        CheckCurrentMethodListener::class,
    ];

    public function __construct(public Request $request)
    {
    }
}
