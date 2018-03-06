<?php
namespace Gap\Db\MySql\Sql;

class SelectSql extends ManipulateSql
{
    protected $selectArr;

    public function select(string ...$selectArr): void
    {
        $this->selectArr = $selectArr;
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
        $sql .= ' OFFSET ' . $this->offset;

        return $sql;
    }
}
