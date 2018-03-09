<?php
namespace Gap\Db\MySql\Sql\Part;

use Gap\Db\Pdo\Param\ParamBase;

class SetPart extends PartBase
{
    protected $field;
    protected $res;

    public function __construct(string $field)
    {
        $this->field = $field;
    }

    public function partSql(): string
    {
        return $this->field . ' = ' . $this->res;
    }

    public function beExpr(string $expr): void
    {
        $this->res = $expr;
    }

    public function beParam(ParamBase $param): void
    {
        $this->res = $param->key();
    }
}
