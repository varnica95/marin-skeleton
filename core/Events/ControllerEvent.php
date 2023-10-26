<?php

namespace Core\Events;

use Core\Http\Request;
use Core\Listeners\ControllerArgumentListener;
use Core\Services\EventDispatcher\EventInterface;

class ControllerEvent implements EventInterface
{
    public array $listeners = [
        ControllerArgumentListener::class,
    ];

    private object $controller;

    private string $method = '__invoke';

    private array $arguments = [];

    public function __construct(public Request $request)
    {
    }

    public function getController(): object
    {
        return $this->controller;
    }

    public function setController(object $controller): void
    {
        $this->controller = $controller;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function setArguments(array $arguments): void
    {
        $this->arguments = $arguments;
    }
}
