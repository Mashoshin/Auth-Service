<?php

namespace Modules\Redis\Infrastructure;

use Redis;
use SessionHandlerInterface;

class RedisSessionHandler implements SessionHandlerInterface
{
    public function __construct(
        private ?Redis $redis,
        private string $prefix = 'PHPSESSID:'
    ) {}

    /**
     * @inheritDoc
     */
    public function open($path, $name): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function close(): bool
    {
        $this->redis = null;
        return true;
    }

    /**
     * @inheritDoc
     */
    public function read($id): string|false
    {
        $key = $this->getKey($id);
        return $this->redis->get($key) ?? false;
    }

    /**
     * @inheritDoc
     */
    public function write($id, $data): bool
    {
        $key = $this->getKey($id);
        $this->redis->set($key, $data);
        return true;
    }

    /**
     * @inheritDoc
     */
    public function destroy($id): bool
    {
        $this->redis->del($this->getKey($id));
        return true;
    }

    /**
     * @inheritDoc
     */
    public function gc($max_lifetime): int|false
    {
        return 1;
    }

    private function getKey(string $id): string
    {
        return $this->prefix . $id;
    }
}
