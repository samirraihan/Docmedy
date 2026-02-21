<?php

namespace App\Core\Results;

class ActionResult
{
    public function __construct(
        public bool $success,
        public ?string $message = null,
        public mixed $data = null
    ) {}

    public static function success($data = null): self
    {
        return new self(true, null, $data);
    }

    public static function fail(string $message): self
    {
        return new self(false, $message);
    }
}