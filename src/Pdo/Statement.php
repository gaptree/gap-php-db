<?php
namespace Gap\Db\Pdo;

use Gap\Db\Pdo\Param\ParamBase;

class Statement
{
    protected $stmt;
    protected $sql;
    protected $paramArr = [];

    public function __construct(\PDO $pdo, string $sql)
    {
        $this->stmt = $pdo->prepare($sql);
        $this->sql = $sql;
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
        $this->paramArr = $paramArr;
        foreach ($paramArr as $param) {
            $this->stmt->bindValue($param->key(), $param->val(), $param->type());
        }
    }

    public function sql(): string
    {
        return $this->sql;
    }

    public function params(): array
    {
        return $this->paramArr;
    }

    public function vals(): array
    {
        $arr = [];
        foreach ($this->paramArr as $param) {
            $arr[$param->key()] = $param->val();
        }
        return $arr;
    }
}
