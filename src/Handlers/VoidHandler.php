<?php

declare(strict_types=1);

namespace Crutch\Consumer\Handlers;

use Crutch\Consumer\ConsumerHandler;

final class VoidHandler implements ConsumerHandler
{
    public function handle(string $message, string $topic): void
    {
    }
}
