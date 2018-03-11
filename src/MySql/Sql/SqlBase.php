<?php
namespace Gap\Db\MySql\Sql;

use Gap\Db\MySql\Cnn;
use Gap\Db\Pdo\Param\ParamStr;
use Gap\Db\Pdo\Param\ParamInt;
use Gap\Db\Pdo\Param\ParamBool;
use Gap\Db\Pdo\Param\ParamDateTime;

use Gap\Db\Pdo\Statement;

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

    public function paramDateTime(\DateTime $val): ParamDateTime
    {
        $param = new ParamDateTime($val);
        $this->paramArr[] = $param;
        return  $param;
    }

    public function execute(): Statement
    {
        $stmt = $this->cnn->prepare($this->sql());
        $stmt->bindParam(...$this->paramArr);
        $stmt->execute();
        return $stmt;
    }

    abstract public function sql(): string;
}
