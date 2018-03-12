<?php
namespace Gap\Db\MySql\Sql\Part;

class TablePart extends PartBase
{
    protected $tableArr;
    protected $joinPartArr = [];

    public function __construct(string ...$tableArr)
    {
        $this->tableArr = $tableArr;
    }

    public function join(string ...$tableArr): JoinPart
    {
        $joinPart = new JoinPart($this, ...$tableArr);
        $this->joinPartArr[] = $joinPart;
        return $joinPart;
    }

    public function leftJoin(string ...$tableArr): JoinPart
    {
        return $this->join(...$tableArr)->pre('LEFT');
    }
    
    public function rightJoin(string ...$tableArr): JoinPart
    {
        return $this->join(...$tableArr)->pre('RIGHT');
    }
    
    public function innerJoin(string ...$tableArr): JoinPart
    {
        return $this->join(...$tableArr)->pre('INNER');
    }
    
    public function outerJoin(string ...$tableArr): JoinPart
    {
        return $this->join(...$tableArr)->pre('OUTER');
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
