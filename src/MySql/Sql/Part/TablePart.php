<?php
namespace Gap\Db\MySql\Sql\Part;

class TablePart extends PartBase
{
    protected $tableArr;
    protected $joinPartArr = [];

    public function table(string ...$tableArr): void
    {
        $this->tableArr = $tableArr;
    }

    public function getJoinPart(): JoinPart
    {
        $joinPart = new JoinPart();
        $this->joinPartArr[] = $joinPart;
        return $joinPart;
    }

    public function partSql(): string
    {
        $sql = implode(', ', $this->tableArr);

        if ($this->joinPartArr) {
            $sql .= ' ' . implode(' ', $this->joinPartArr);
        }

        return $sql;
    }
}
