<?php
namespace Gap\Db\Pdo;

use Gap\Db\Contract\TransactionInterface;

class Transaction implements TransactionInterface
{
    protected $pdo;
    protected $transLevel = 0;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function begin(): void
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
}
