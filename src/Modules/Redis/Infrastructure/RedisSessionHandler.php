<?php

namespace src\Modules\Redis\Infrastructure;

use Predis\Client;
use SessionHandlerInterface;

class RedisSessionHandler implements SessionHandlerInterface
{
    private ?Client $redis;
    private string $prefix;

    public function __construct(Client $redis, string $prefix = 'PHPSESSID:')
    {
        $this->redis = $redis;
        $this->prefix = $prefix;
    }

    /**
     * @inheritDoc
     */
    public function open($path, $name)
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function close()
    {
        $this->redis = null;
        return true;
    }

    /**
     * @inheritDoc
     */
    public function read($id)
    {
        $key = $this->getKey($id);
        return $this->redis->get($key) ?? '';
    }

    /**
     * @inheritDoc
     */
    public function write($id, $data)
    {
        $key = $this->getKey($id);
        $this->redis->set($key, $data);
        return true;
    }

    /**
     * @inheritDoc
     */
    public function destroy($id)
    {
        $this->redis->del($this->getKey($id));
        return true;
    }

    /**
     * @inheritDoc
     */
    public function gc($max_lifetime)
    {
        return true;
    }

    private function getKey(string $id): string
    {
        return $this->prefix . $id;
    }
}
