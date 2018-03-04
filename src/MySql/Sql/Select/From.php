<?php
namespace Gap\Db\MySql\Sql\Select;

class From extends Base
{
    protected $fromArr;

    public function from(string ...$fromArr): self
    {
        $this->fromArr = $fromArr;
        return $this;
    }

    public function partSql(): string
    {
        return implode(', ', $this->fromArr);
    }
}
