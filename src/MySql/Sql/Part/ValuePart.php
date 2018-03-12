<?php
namespace Gap\Db\MySql\Sql\Part;

use Gap\Db\Pdo\Param\ParamBase;

class ValuePart extends PartBase
{
    protected $paramArr = [];

    public function partSql(): string
    {
        return '(' . implode(', ', $this->paramArr) . ')';
    }

    public function add(ParamBase $param): self
    {
        $this->paramArr[] = $param;
        return $this;
    }
}
