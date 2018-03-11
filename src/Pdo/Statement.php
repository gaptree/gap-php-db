<?php
namespace Gap\Db\Pdo;

use Gap\Db\Pdo\Param\ParamBase;

class Statement
{
    protected $stmt;

    public function __construct(\PDOStatement $stmt)
    {
        $this->stmt = $stmt;
    }

    public function execute(): void
    {
        if (!$this->stmt->execute()) {
            throw new \Exception('Statement execute failed');
        }
    }

    public function fetchAssoc(): array
    {
        //$this->stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $this->execute();
        return $this->stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function fetch(string $class)
    {
        return new $class($this->fetchAssoc());
    }

    public function list(string $class): RowCollection
    {
        return new RowCollection($this, $class);
    }

    public function listAssoc(): array
    {
        $this->execute();
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function bindValue(ParamBase ...$paramArr): void
    {
        foreach ($paramArr as $param) {
            $this->stmt->bindValue($param->key(), $param->val(), $param->type());
        }
    }
}
