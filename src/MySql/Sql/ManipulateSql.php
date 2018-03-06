<?php

// Data Manipulation Statements:
// https://dev.mysql.com/doc/refman/5.7/en/sql-syntax-data-manipulation.html

namespace Gap\Db\MySql\Sql;

abstract class ManipulateSql extends SqlBase
{
    protected $tablePart;
    protected $wherePart;

    protected $groupByArr = [];
    protected $orderByArr = [];

    protected $limit = 10;
    protected $offset = 0;

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

    public function groupBy(string $field, $sort = ''): void
    {
        $sort = $sort ? ' ' . $sort : '';
        $this->groupByArr[] = $field . $sort;
    }

    public function ascGroupBy(string $field): void
    {
        $this->groupBy($field, 'ASC');
    }

    public function descGroupBy(string $field): void
    {
        $this->groupBy($field, 'DESC');
    }

    public function orderBy(string $field, $sort = ''): void
    {
        $sort = $sort ? ' ' . $sort : '';
        $this->orderByArr[] = $field . $sort;
    }

    public function ascOrderBy(string $field): void
    {
        $this->orderBy($field, 'ASC');
    }

    public function descOrderBy(string $field): void
    {
        $this->orderBy($field, 'DESC');
    }

    /*
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
    */
}