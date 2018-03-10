<?php
namespace Gap\Db\MySql\Ctrl\Tool\Support;

use Gap\Db\Pdo\Param\ParamStr;
use Gap\Db\Pdo\Param\ParamInt;
use Gap\Db\Pdo\Param\ParamBool;
use Gap\Db\Pdo\Param\ParamDateTime;
use Gap\Db\Pdo\Param\ParamBase;

trait ToolParamTrait
{
    public function paramStr(string $val): ParamStr
    {
        return $this->manipulateSql->paramStr($val);
    }

    public function paramInt(int $val): ParamInt
    {
        return $this->manipulateSql->paramInt($val);
    }

    public function paramBool(bool $val): ParamBool
    {
        return $this->manipulateSql->paramBool($val);
    }

    public function paramFloat(string $val): ParamStr
    {
        return $this->paramStr($val);
    }

    public function paramNumber($val): ParamBase
    {
        return is_int($val) ? $this->paramInt($val) : $this->paramFloat($val);
    }

    public function paramDateTime(\DateTime $dateTime): ParamDateTime
    {
        return $this->manipulateSql->paramDateTime($dateTime);
        //return $this->paramStr($dateTime->format('Y-m-d H:i:s.u'));
    }
}
