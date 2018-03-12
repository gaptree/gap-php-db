<?php
namespace Gap\Db\MySql\Sql;

use Gap\Db\Pdo\Param\ParamBase;

class UpdateSql extends ManipulateSql
{
    protected $limit = 0;
    protected $setPartArr = [];

    public function sql(): string
    {
        $sql = 'UPDATE ' . $this->tablePart;
        $sql .= ' SET ' . implode(', ', $this->setPartArr);
        if ($this->wherePart) {
            $sql .= ' WHERE ' . $this->wherePart;
        }

        if ($this->orderByArr) {
            $sql .= ' ORDER BY ' . implode(', ', $this->orderByArr);
        }

        if ($this->limit) {
            $sql .= ' LIMIT ' . $this->limit;
            $sql .= ' OFFSET ' . $this->offset;
        }

        return $sql;
    }

    public function update(Part\TablePart $tablePart): self
    {
        $this->tablePart = $tablePart;
        return $this;
    }

    public function set(string $field, ParamBase $param): self
    {
        $setPart = new Part\SetPart($field, $param);
        $this->setPartArr[] = $setPart;
        return $this;
    }
}
