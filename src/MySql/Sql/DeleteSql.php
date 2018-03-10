<?php
namespace Gap\Db\MySql\Sql;

class DeleteSql extends ManipulateSql
{
    protected $deleteArr;

    public function delete(string ...$deleteArr): void
    {
        $this->deleteArr = $deleteArr;
    }

    public function sql(): string
    {
        $sql = 'DELETE ' . implode(', ', $this->deleteArr)
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
