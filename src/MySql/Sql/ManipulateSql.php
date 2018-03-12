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

    public function limit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset(int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    public function groupBy(string $field, $sort = ''): self
    {
        $sort = $sort ? ' ' . $sort : '';
        $this->groupByArr[] = $field . $sort;
        return $this;
    }

    public function ascGroupBy(string $field): self
    {
        return $this->groupBy($field, 'ASC');
    }

    public function descGroupBy(string $field): self
    {
        return $this->groupBy($field, 'DESC');
    }

    public function orderBy(string $field, $sort = ''): self
    {
        $sort = $sort ? ' ' . $sort : '';
        $this->orderByArr[] = $field . $sort;
        return $this;
    }

    public function ascOrderBy(string $field): self
    {
        return $this->orderBy($field, 'ASC');
    }

    public function descOrderBy(string $field): self
    {
        return $this->orderBy($field, 'DESC');
    }

    public function table(Part\TablePart $table): self
    {
        $this->tablePart = $table;
        return $this;
    }

    public function where(Part\CondPart $cond): self
    {
        $this->wherePart = $cond;
        return $this;
    }

    /*
    public function getTablePart(): Part\TablePart
    {
        if ($this->tablePart) {
            return $this->tablePart;
        }
        $this->tablePart = new Part\TablePart();
        return $this->tablePart;
    }
    */

    /*
    public function getWherePart(): Part\WherePart
    {
        if ($this->wherePart) {
            return $this->wherePart;
        }

        $this->wherePart = new Part\WherePart();
        return $this->wherePart;
    }
    */

    /*
    public function fetchAssoc(): array
    {
        $this->limit(1);
        return $this->prepare()->fetchAssoc();
    }

    public function fetch(string $class)
    {
        $this->limit(1);
        return $this->prepare()->fetch($class);
    }

    public function list(string $class): RowCollection
    {
        return new RowCollection(
            $this->prepare(),
            $class
        );
    }

    public function listAssoc(): array
    {
        return $this->prepare()->listAssoc();
    }
    */

    /*
    public function ascGroupBy(string $field): void
    {
        $this->groupBy($field, 'ASC');
    }

    public function descGroupBy(string $field): void
    {
        $this->groupBy($field, 'DESC');
    }

    public function ascOrderBy(string $field): void
    {
        $this->orderBy($field, 'ASC');
    }

    public function descOrderBy(string $field): void
    {
        $this->orderBy($field, 'DESC');
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
    */
}
