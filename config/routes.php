<?php

return [
    '/{locale}/posts/{post}/create' => [
        'methods' => ['GET', 'POST'],
        'handler' => ['controller', 'method'],
        'middlewares' => [],
    ]
];
