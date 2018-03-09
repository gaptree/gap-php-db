<?php
namespace Gap\Db\MySql\Sql;

class UpdateSql extends ManipulateSql
{
    protected $limit = 0;

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
}
