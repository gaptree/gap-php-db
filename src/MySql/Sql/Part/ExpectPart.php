<?php
namespace Gap\Db\MySql\Sql\Part;

use Gap\Db\Pdo\Param\ParamBase;

class ExpectPart extends PartBase
{
    protected $cond;
    protected $field;
    protected $pre = '';

    protected $operate;
    protected $res;

    public function __construct(CondPart $cond, string $field, string $pre = '')
    {
        $this->cond = $cond;
        $this->field = $field;
        $this->pre = $pre;
    }

    public function partSql(): string
    {
        $sql = $this->pre ? $this->pre . ' ' : '';
        $sql .= $this->field  . ' ' . $this->operate . ' ' . $this->res;
        return $sql;
    }

    public function equal(ParamBase $param): CondPart
    {
        return $this->cond('=', $param);
    }

    public function like(ParamBase $param): CondPart
    {
        return $this->cond('LIKE', $param);
    }

    public function greater(ParamBase $param): CondPart
    {
        return $this->cond('>', $param);
    }

    public function greaterEqual(ParamBase $param): CondPart
    {
        return $this->cond('>=', $param);
    }

    public function less(ParamBase $param): CondPart
    {
        return $this->cond('<', $param);
    }

    public function lessEqual(ParamBase $param): CondPart
    {
        return $this->cond('<=', $param);
    }

    public function cond(string $operate, ParamBase $param): CondPart
    {
        $this->operate = $operate;
        $this->res = $param->key();
        return $this->cond;
    }

    public function condArr(string $operate, array $params): CondPart
    {
        $this->operate = $operate;
        $keys = [];
        foreach ($params as $param) {
            $keys[] = $param->key();
        }
        $this->res = '(' . implode(', ', $keys) . ')';
        return $this->cond;
    }
    /*
    public function expr(string $operate, string $expr): void
    {
        $this->operate = $operate;
        $this->res = $expr;
        $this->paramArr = [];
    }

    */

    /*
    public function inCond(array $keyArr, array $paramArr): void
    {
        $this->operate = 'IN';
        $this->res = '(' . implode(', ', $keyArr) . ')';
        $this->paramArr = $paramArr;
    }
    */
}
