<?php

declare(strict_types=1);

namespace Crutch\Consumer\Consumers;

use InvalidArgumentException;
use Crutch\Consumer\Consumer;
use Crutch\Consumer\ConsumerHandler;

final class RouteConsumer implements Consumer
{
    /** @var array<string, Consumer> */
    private array $consumers = [];

    public function __construct(Consumer $defaultConsumer)
    {
        $this->consumers[''] = $defaultConsumer;
    }

    public function setConsumer(string $topic, Consumer $consumer): void
    {
        $topic = $this->checkTopic($topic);
        $this->consumers[$topic] = $consumer;
    }

    public function consume(string $topic, ConsumerHandler $handler): void
    {
        $consumer = $this->getConsumer($topic);
        $consumer->consume($topic, $handler);
    }

    private function getConsumer(string $topic): Consumer
    {
        $topic = $this->checkTopic($topic);
        if (!array_key_exists($topic, $this->consumers)) {
            return $this->consumers[''];
        }
        return $this->consumers[$topic];
    }

    private function checkTopic(string $topic): string
    {
        $topic = trim($topic);
        if ($topic === '') {
            throw new InvalidArgumentException('topic can nor be empty');
        }
        return $topic;
    }
}
