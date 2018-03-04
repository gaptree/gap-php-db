<?php
namespace Gap\Db\MySql\Sql\Util;

class CondBase
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

    public function beStr(string $val): void
    {
        $this->cond('=', new ParamStr($val));
    }

    public function beInt(int $val): void
    {
        $this->cond('=', new ParamInt($val));
    }

    public function like(string $val): void
    {
        $this->cond('LIKE', new ParamStr($val));
    }

    protected function cond(string $operate, Param $param): void
    {
        $this->operate = $operate;
        $this->res = $param->key();
        $this->paramArr = [$param];
    }

    protected function inCond(array $keyArr, array $paramArr): void
    {
        $this->operate = 'IN';
        $this->res = '(' . implode(', ', $keyArr) . ')';
        $this->paramArr = $paramArr;
    }
}
