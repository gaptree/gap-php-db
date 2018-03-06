<?php
namespace Gap\Db\MySql\Sql;

use Gap\Db\MySql\Cnn;
use Gap\Db\MySql\Param\ParamStr;
use Gap\Db\MySql\Param\ParamInt;
use Gap\Db\MySql\Param\ParamBool;

abstract class SqlBase
{
    protected $paramArr = [];
    protected $cnn;

    public function __construct(Cnn $cnn)
    {
        $this->cnn = $cnn;
    }

    public function paramStr(string $val): ParamStr
    {
        $param = new ParamStr($val);
        $this->paramArr[] = $param;
        return $param;
    }

    public function paramInt(int $val): ParamInt
    {
        $param = new ParamInt($val);
        $this->paramArr[] = $param;
        return $param;
    }

    public function paramBool(bool $val): ParamBool
    {
        $param = new ParamBool($val);
        $this->paramArr[] = $param;
        return $param;
    }

    abstract public function sql(): string;
}
