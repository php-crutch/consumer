# crutch/consumer

consumer interface

# Install

```bash
composer require crutch/consumer
```

You may use `\Crutch\Consumer\Consumers\RouteConsumer` for split consumers by topic

```php
<?php

/** @var Crutch\Consumer\Consumer $defaultConsumer */
/** @var Crutch\Consumer\Consumer $topicOneConsumer */
/** @var Crutch\Consumer\Consumer $topicTwoConsumer */
/** @var Crutch\Consumer\ConsumerHandler $handler */

$consumer = new Crutch\Consumer\Consumers\RouteConsumer($defaultConsumer);
$consumer->setConsumer('one', $topicOneConsumer);
$consumer->setConsumer('two', $topicTwoConsumer);

$consumer->consume('one', $handler); // consumed by $topicOneConsumer
$consumer->consume('two', $handler); // consumed by $topicTwoConsumer
$consumer->consume('three', $handler); // consumed by $defaultConsumer
```

You may use `\Crutch\Consumer\Handlers\RouteHandler` for split handlers by topic

```php
<?php

/** @var Crutch\Consumer\ConsumerHandler $defaultHandler */
/** @var Crutch\Consumer\ConsumerHandler $topicOneHandler */
/** @var Crutch\Consumer\ConsumerHandler $topicTwoHandler */

$handler = new Crutch\Consumer\Handlers\RouteHandler($defaultHandler);
$handler->setHandler('one', $topicOneHandler);
$handler->setHandler('two', $topicTwoHandler);

$handler->handle('message 1', 'one'); // handled by $topicOneHandler
$handler->handle('message 2', 'two'); // handled by $topicTwoHandler
$handler->handle('message 3', 'three'); // handled by $defaultHandler
```
