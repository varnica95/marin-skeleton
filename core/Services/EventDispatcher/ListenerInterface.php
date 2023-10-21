<?php

namespace Core\Services\EventDispatcher;

interface ListenerInterface
{
    public function handle(EventInterface $event): void;
}
