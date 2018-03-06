<?php

// Data Manipulation Statements:
// https://dev.mysql.com/doc/refman/5.7/en/sql-syntax-data-manipulation.html

namespace Gap\Db\MySql\Sql;

abstract class ManipulateSql
{
    protected $tablePart;
    protected $wherePart;

    protected $groupByPart;
    protected $orderByPart;

    protected $limit;
    protected $offset;

    abstract public function sql(): string;

    public function limit(int $limit): void
    {
        $this->limit = $limit;
    }

    public function offset(int $offset): void
    {
        $this->offset = $offset;
    }

    public function getTablePart(): Part\TablePart
    {
        if ($this->tablePart) {
            return $this->tablePart;
        }
        $this->tablePart = new Part\TablePart();
        return $this->tablePart;
    }

    public function getWherePart(): Part\WherePart
    {
        if ($this->wherePart) {
            return $this->wherePart;
        }

        $this->wherePart = new Part\WherePart();
        return $this->wherePart;
    }

    public function getOrderByPart(): Part\OrderByPart
    {
        if ($this->orderByPart) {
            return $this->orderByPart;
        }

        $this->orderByPart = new Part\OrderByPart();
        return $this->orderByPart;
    }

    public function getGroupByPart(): Part\GroupByPart
    {
        if ($this->groupByPart) {
            return $this->groupByPart;
        }
        $this->groupByPart = new Part\GroupByPart();
        return $this->groupByPart;
    }
}
