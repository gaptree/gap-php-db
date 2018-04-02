<?php
namespace Gap\Db\MySql\Sql;

use Gap\Db\MySql\Collection;

class SelectSql extends ManipulateSql
{
    protected $selectArr;

    public function select(string ...$selectArr): self
    {
        $this->selectArr = $selectArr;
        return $this;
    }

    public function from(Part\TablePart $table): self
    {
        $this->table($table);
        return $this;
    }

    public function sql(): string
    {
        $sql = 'SELECT ' . implode(', ', $this->selectArr)
            . ' FROM ' . $this->tablePart;

        if ($this->wherePart) {
            $sql .= ' WHERE ' . $this->wherePart;
        }

        if ($this->groupByArr) {
            $sql .= ' GROUP BY ' . implode(', ', $this->groupByArr);
        }

        if ($this->orderByArr) {
            $sql .= ' ORDER BY ' . implode(', ', $this->orderByArr);
        }

        $sql .= ' LIMIT ' . $this->limit;

        if ($this->offset) {
            $sql .= ' OFFSET ' . $this->offset;
        }

        return $sql;
    }

    public function countSql(): string
    {
        $sql = 'SELECT count(1) `count`'
            . ' FROM ' . $this->tablePart;
        if ($this->wherePart) {
            $sql .= ' WHERE ' . $this->wherePart;
        }
        $sql .= ' LIMIT 1';
        return $sql;
    }

    public function fetchAssoc(): array
    {
        return $this->query()->fetchAssoc();
    }

    public function listAssoc(): array
    {
        return $this->query()
            ->listAssoc();
    }

    public function fetch(string $class)
    {
        return $this->query()->fetch($class);
    }

    public function list(string $class)
    {
        return new Collection($this, $class);
    }

    public function count(): int
    {
        $stmt = $this->cnn->query($this->countSql());
        if ($arr = $stmt->fetchAssoc()) {
            return (int) $arr['count'];
        }

        return 0;
    }
}
