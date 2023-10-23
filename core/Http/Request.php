<?php

namespace Core\Http;

use Core\Http\Bags\QueryBag;
use Core\Http\Bags\RequestBag;
use Core\Http\Bags\ServerBag;

class Request
{
    public QueryBag $query;
    public RequestBag $request;
    public ServerBag $server;
    private Route $route;

    public function __construct()
    {
        $this->query = new QueryBag($_GET);
        $this->request = new RequestBag($_POST);
        $this->server = new ServerBag($_SERVER);
    }

    public function getRoute(): Route
    {
        return $this->route;
    }

    public function setRoute(Route $route): void
    {
        $this->route = $route;
    }
}
