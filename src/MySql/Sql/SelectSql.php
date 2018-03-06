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

        return $sql;
    }
}
