<?php
namespace Gap\Db\MySql\Sql;

class SelectSql extends SqlBase
{
    protected $select;
    protected $from;
    protected $where;
    protected $offset = 0;
    protected $limit = 10;

    public function limit(int $limit): void
    {
        $this->limit = $limit;
    }

    public function offset(int $offset): void
    {
        $this->offset = $offset;
    }

    public function getSelect(): Select\Select
    {
        if ($this->select) {
            return $this->select;
        }

        $this->select = new Select\Select($this);
        return $this->select;
    }

    public function getFrom(): Select\From
    {
        if ($this->from) {
            return $this->from;
        }

        $this->from = new Select\From($this);
        return $this->from;
    }

    public function sql(): string
    {
        return 'SELECT ' . $this->select->partSql()
            . ' FROM ' . $this->from->partSql()
            . ($this->where ? ' WHERE ' . $this->where->partSql() : '')
            . ' LIMIT ' . $this->limit
            . ' OFFSET ' . $this->offset;
    }

    public function getWhere(): Select\Where
    {
        if ($this->where) {
            return $this->where;
        }

        $this->where = new Select\Where($this);
        return $this->where;
    }

    /*
    public function getJoin(): Select\Join
    {
        if ($this->join) {
            return $this->join;
        }

        $this->join = new Select\Join();
        return $thi->join;
    }
    */
}
