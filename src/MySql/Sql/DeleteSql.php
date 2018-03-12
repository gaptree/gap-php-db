<?php
namespace Gap\Db\MySql\Sql;

class DeleteSql extends ManipulateSql
{
    protected $deleteArr;

    public function delete(string ...$deleteArr): self
    {
        $this->deleteArr = $deleteArr;
        return $this;
    }

    public function from(Part\TablePart $tablePart): self
    {
        $this->table($tablePart);
        return $this;
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
