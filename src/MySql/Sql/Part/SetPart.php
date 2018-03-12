<?php
namespace Gap\Db\MySql\Sql\Part;

use Gap\Db\Pdo\Param\ParamBase;

class SetPart extends PartBase
{
    protected $field;
    protected $res;

    public function __construct(string $field, ParamBase $param)
    {
        $this->field = $field;
        $this->res = $param->key();
    }

    public function partSql(): string
    {
        return $this->field . ' = ' . $this->res;
    }
}
