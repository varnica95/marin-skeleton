<?php

namespace Core\Http;

class Route
{
    private string $uri;
    private array $handler;
    private array $methods = ['GET'];
    private array $middlewares = [];
    private array $variables = [];

    public function getUri(): string
    {
        return $this->uri;
    }

    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    public function getHandler(): array
    {
        return $this->handler;
    }

    public function setHandler(array $handler): void
    {
        $this->handler = $handler;
    }

    public function getMethods(): array
    {
        return $this->methods;
    }

    public function setMethods(array $methods): void
    {
        $this->methods = $methods;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    public function setMiddlewares(array $middlewares): void
    {
        $this->middlewares = $middlewares;
    }

    public function getVariables(): array
    {
        return $this->variables;
    }

    public function setVariables(array $variables): void
    {
        $this->variables = $variables;
    }
}
