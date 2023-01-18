<?php

declare(strict_types=1);

namespace Crutch\Consumer\Consumers;

use Crutch\Consumer\Consumer;
use Crutch\Consumer\ConsumerHandler;

final class VoidConsumer implements Consumer
{
    public function consume(string $topic, ConsumerHandler $handler): void
    {
    }
}
