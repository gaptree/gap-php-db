<?php
namespace Gap\Db\MySql\Sql\Util;

class Cond extends CondBase
{
    public function greater(int $val): void
    {
        $this->cond('>', new ParamInt($val));
    }

    public function greaterEqual(int $val): void
    {
        $this->cond('>=', new ParamInt($val));
    }

    public function less(int $val): void
    {
        $this->cond('<', new ParamInt($val));
    }

    public function lessEqual(int $val): void
    {
        $this->cond('<=', new ParamInt($val));
    }

    public function inInt(int ...$valArr): void
    {
        $keyArr = [];
        $paramArr = [];

        foreach ($valArr as $val) {
            $param = new ParamInt($val);
            $keyArr[] = $param->key();
            $paramArr[] = $param;
        }

        $this->inCond($keyArr, $paramArr);
    }

    public function inStr(string ...$valArr): void
    {
        $keyArr = [];
        $paramArr = [];

        foreach ($valArr as $val) {
            $param = new ParamStr($val);
            $keyArr[] = $param->key();
            $paramArr[] = $param;
        }

        $this->inCond($keyArr, $paramArr);
    }
}
