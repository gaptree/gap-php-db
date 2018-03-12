<?php
namespace Gap\Db\MySql\Sql\Part;

class JoinPart extends PartBase
{
    protected $tablePart;
    protected $tableArr = [];
    protected $pre = '';
    protected $condPart;

    public function __construct(TablePart $tablePart, string ...$tableArr)
    {
        $this->tablePart = $tablePart;
        $this->tableArr = $tableArr;
    }

    public function partSql(): string
    {
        $sql = $this->pre ? ($this->pre . ' ') : '';
        $sql .= 'JOIN ' . implode(', ', $this->tableArr);
        
        if ($this->condPart) {
            $sql .=  ' ON ' . $this->condPart->partSql();
        }
        return $sql;
    }

    public function pre(string $pre): self
    {
        $this->pre = $pre; // LEFT, RIGHT, INNER, OUTER
        return $this;
    }
    /*
    public function left(): void
    {
        $this->pre = 'LEFT';
    }

    public function right(): void
    {
        $this->pre = 'RIGHT';
    }

    public function inner(): void
    {
        $this->pre = 'inner';
    }

    public function outer(): void
    {
        $this->pre = 'outer';
    }
    */

    public function onCond(CondPart $condPart): TablePart
    {
        $this->condPart = $condPart;
        return $this->tablePart;
    }
}
