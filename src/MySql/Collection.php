<?php
namespace Gap\Db\MySql;

class Collection extends \Gap\Db\Collection
{
    protected $selectSql;
    protected $stmt;

    protected $index = 0;
    protected $class;
    protected $current;

    public function __construct(Sql\SelectSql $selectSql, string $class)
    {
        $this->selectSql = $selectSql;
        $this->class = $class;
    }

    public function current()
    {
        return $this->current;
    }

    public function key()
    {
        return $this->index;
    }

    public function next()
    {
        $this->index++;
        $this->current = $this->stmt->fetch($this->class);
    }

    public function rewind()
    {
        $this->stmt = $this->selectSql->query();
        $this->current = $this->stmt->fetch($this->class);
    }

    public function valid()
    {
        return $this->current ? true : false;
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
}
