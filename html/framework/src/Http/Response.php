<?php

namespace Bek\Framework\Http;

class Response {
    public function __construct(
        private mixed $content,
        private int $statusCode = 200,
        private array $headers = [],
    )
    {
        http_response_code($statusCode);
    }

    public function send():void
    {
        echo $this->content;
    }
}