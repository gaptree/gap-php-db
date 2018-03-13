<?php
namespace Gap\Db\MySql\SqlBuilder;

use Gap\Db\MySql\Sql\SelectSql;
use Gap\Db\MySql\Cnn;
use Gap\Db\Collection;

class SelectSqlBuilder extends ManipulateSqlBuilder
{
    public function __construct(Cnn $cnn, SelectSql $selectSql)
    {
        $this->cnn =$cnn;
        $this->sql = $selectSql;
    }

    public function select(string ...$selectArr): self
    {
        $this->sql->select(...$selectArr);
        return $this;
    }

    public function from(string ...$tableArr): Tool\TableTool
    {
        return $this->table(...$tableArr);
    }

    public function fetch(string $class)
    {
        return $this->sql->fetch($class);
    }

    public function fetchAssoc(): array
    {
        return $this->sql->fetchAssoc();
    }

    public function list(string $class): Collection
    {
        return $this->sql->list($class);
    }

    public function listAssoc()
    {
        return $this->sql->listAssoc();
    }
}
