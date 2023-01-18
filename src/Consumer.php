<?php

declare(strict_types=1);

namespace Crutch\Consumer;

interface Consumer
{
    public function consume(string $topic, ConsumerHandler $handler): void;
}
