<?php
namespace Gap\Db\MySql\Sql\Part;

class JoinPart extends PartBase
{
    protected $tableArr = [];
    protected $pre = '';
    protected $wherePart;

    public function table(string ...$tableArr): void
    {
        $this->tableArr = $tableArr;
    }

    public function partSql(): string
    {
        $sql = $this->pre ? ($this->pre . ' ') : '';
        $sql .= 'JOIN ' . implode(', ', $this->tableArr);
        
        if ($this->wherePart) {
            $sql .=  ' ON ' . $this->wherePart->partSql();
        }
        return $sql;
    }
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

    public function getWherePart(): WherePart
    {
        if ($this->wherePart) {
            return $this->wherePart;
        }

        $this->wherePart = new WherePart();
        return $this->wherePart;
    }
}
