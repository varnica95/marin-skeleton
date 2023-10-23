<?php

namespace Core\Http\Middleware;

use Core\Http\Request;

class Middleware
{
    protected \Closure $root;

    public function __construct()
    {
        $this->root = fn (Request $request) => $request;
    }

    public function add(MiddlewareInterface $middleware): void
    {
        $next = $this->root;

        $this->root = function (Request $request) use ($middleware, $next) {
            return $middleware->handle($request, $next);
        };
    }

    public function handle(Request $request): mixed
    {
        return call_user_func($this->root, $request);
    }
}
