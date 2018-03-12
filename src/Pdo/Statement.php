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
        $res = $this->stmt->fetch(\PDO::FETCH_ASSOC);
        if (empty($res)) {
            return [];
        }
        return $res;
    }

    public function fetch(string $class)
    {
        if ($arr = $this->fetchAssoc()) {
            return new $class($arr);
        }

        return null;
    }

    /*
    public function list(string $class): RowCollection
    {
        return new RowCollection($this, $class);
    }
    */

    public function listAssoc(): array
    {
        $this->execute();
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function bindParam(ParamBase ...$paramArr): void
    {
        foreach ($paramArr as $param) {
            $this->stmt->bindValue($param->key(), $param->val(), $param->type());
        }
    }
}
