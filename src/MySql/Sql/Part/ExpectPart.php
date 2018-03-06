<?php
namespace Gap\Db\MySql\Sql\Part;

use Gap\Db\MySql\Param\ParamBase;

class ExpectPart extends PartBase
{
    protected $pre = '';
    protected $field;
    protected $operate;
    protected $res;

    protected $paramArr = [];

    public function __construct(string $field, string $pre = '')
    {
        $this->field = $field;
        $this->pre = $pre;
    }

    public function partSql(): string
    {
        $sql = $this->pre ? $this->pre . ' ' : '';
        $sql .= $this->field  . ' ' . $this->operate . ' ' . $this->res;
        return $sql;
    }

    public function expr(string $operate, string $expr): void
    {
        $this->operate = $operate;
        $this->res = $expr;
        $this->paramArr = [];
    }

    public function cond(string $operate, ParamBase $param): void
    {
        $this->operate = $operate;
        $this->res = $param->key();
        $this->paramArr = [$param];
    }

    /*
    public function inCond(array $keyArr, array $paramArr): void
    {
        $this->operate = 'IN';
        $this->res = '(' . implode(', ', $keyArr) . ')';
        $this->paramArr = $paramArr;
    }
    */
}
