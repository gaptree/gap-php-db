<?php
namespace Gap\Db\MySql\Sql\Select;

use Gap\Db\MySql\Sql\SelectSql;

abstract class Base
{
    protected $selectSql;

    public function __construct(SelectSql $selectSql)
    {
        $this->selectSql = $selectSql;
    }

    public function select(string ...$selectArr): Select
    {
        return $this->selectSql->getSelect()->select(...$selectArr);
    }

    public function from(string ...$fromArr): From
    {
        return $this->selectSql->getFrom()->from(...$fromArr);
    }

    public function where(): Where
    {
        return $this->selectSql->getWhere();
    }

    public function limit(int $limit): self
    {
        $this->selectSql->limit($limit);
        return $this;
    }

    public function offset(int $offset): self
    {
        $this->selectSql->offset($offset);
        return $this;
    }

    public function sql(): string
    {
        return $this->selectSql->sql();
    }

    abstract public function partSql(): string;
}
