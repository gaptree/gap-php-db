<?php
namespace Gap\Db\Pdo;

use Gap\Db\CnnInterface;

class Cnn implements CnnInterface
{
    protected $pdo;
    protected $serverId;

    protected $transLevel = 0;

    public function __construct(\PDO $pdo, string $serverId)
    {
        $this->pdo = $pdo;
        $this->serverId = $serverId;
    }

    public function beginTransaction(): void
    {
        $this->transLevel++;
        if ($this->transLevel > 1) {
            return;
        }

        if (!$this->pdo->beginTransaction()) {
            throw new \Exception("db beginTransaction failed");
        }
    }

    public function commit(): void
    {
        if ($this->transLevel <= 0) {
            $this->transLevel = 0;
            throw new \Exception("db commit failed");
        }

        $this->transLevel--;
        if ($this->transLevel > 0) {
            return;
        }

        if (!$this->pdo->commit()) {
            throw new \Exception('db commit failed');
        }
    }

    public function rollback(): void
    {
        if ($this->transLevel === 0) {
            return;
        }

        $this->transLevel = 0;

        if (!$this->pdo->rollback()) {
            throw new \Exception('db rollback failed');
        }
    }

    public function zid(): string
    {
        return uniqid($this->serverId . '-');
    }

    public function zcode(): string
    {
        return uniqid($this->serverId);
    }

    public function prepare(string $sql): Statement
    {
        return new Statement($this->pdo->prepare($sql));
    }
}
