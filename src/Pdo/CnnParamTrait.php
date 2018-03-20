<?php
namespace Gap\Db\Pdo;

trait CnnParamTrait
{
    public function str(string $val): Param\ParamStr
    {
        $param = new Param\ParamStr($val);
        $this->paramArr[] = $param;
        return $param;
    }

    public function int(int $val): Param\ParamInt
    {
        $param = new Param\ParamInt($val);
        $this->paramArr[] = $param;
        return $param;
    }

    public function bool(bool $val): Param\ParamBool
    {
        $param = new Param\ParamBool($val);
        $this->paramArr[] = $param;
        return $param;
    }

    public function dateTime(\DateTime $val): Param\ParamDateTime
    {
        $param = new Param\ParamDateTime($val);
        $this->paramArr[] = $param;
        return  $param;
    }

    public function expr(string $expr): Param\ParamExpr
    {
        return new Param\ParamExpr($expr);
    }
}
