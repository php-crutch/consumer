<?php

declare(strict_types=1);

namespace Crutch\Consumer\Handlers;

use InvalidArgumentException;
use Crutch\Consumer\ConsumerHandler;

final class RouteHandler implements ConsumerHandler
{
    /**
     * @var ConsumerHandler[]
     */
    private array $handlers = [];

    public function __construct(ConsumerHandler $defaultHandler)
    {
        $this->handlers[''] = $defaultHandler;
    }

    public function setHandler(string $topic, ConsumerHandler $handler): void
    {
        $topic = $this->checkTopic($topic);
        $this->handlers[$topic] = $handler;
    }

    public function handle(string $message, string $topic): void
    {
        $handler = $this->getHandler($topic);
        $handler->handle($message, $topic);
    }

    private function checkTopic(string $topic): string
    {
        $topic = trim($topic);
        if ($topic !== '') {
            return $topic;
        }
        throw new InvalidArgumentException('topic can not be empty');
    }

    private function getHandler(string $topic): ConsumerHandler
    {
        $topic = $this->checkTopic($topic);
        if (!array_key_exists($topic, $this->handlers)) {
            return $this->handlers[''];
        }
        return $this->handlers[$topic];
    }
}
