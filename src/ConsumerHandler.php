<?php

declare(strict_types=1);

namespace Crutch\Consumer;

interface ConsumerHandler
{
    public function handle(string $message, string $topic): void;
}
