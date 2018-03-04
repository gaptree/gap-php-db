<?php
namespace Gap\Db\MySql\Sql\Select;

class Select extends Base
{
    protected $selectArr;

    public function select(string ...$selectArr): self
    {
        $this->selectArr = $selectArr;
        return $this;
    }

    public function partSql(): string
    {
        return implode(', ', $this->selectArr);
    }
}
