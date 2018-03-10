<?php
namespace Gap\Db\MySql\Ctrl\Tool;

use Gap\Db\MySql\Ctrl\InsertCtrl;
use Gap\Db\MySql\Sql\Part\ValuePart;

use Gap\Db\Pdo\Param\ParamStr;
use Gap\Db\Pdo\Param\ParamInt;
use Gap\Db\Pdo\Param\ParamBool;
use Gap\Db\Pdo\Param\ParamDateTime;
use Gap\Db\Pdo\Param\ParamBase;

use Gap\Db\Pdo\Statement;

class ValueTool
{
    protected $insertCtrl;
    protected $valuePart;

    public function __construct(InsertCtrl $insertCtrl, ValuePart $valuePart)
    {
        $this->insertCtrl = $insertCtrl;
        $this->valuePart = $valuePart;
    }

    public function addStr(string $val): self
    {
        $this->valuePart->add(new ParamStr($val));
        return $this;
    }

    public function addInt(int $val): self
    {
        $this->valuePart->add(new ParamInt($val));
        return $this;
    }

    public function addBool(bool $val): self
    {
        $this->valuePart->add(new ParamBool($val));
        return $this;
    }

    public function addDateTime(\DateTime $val): self
    {
        $this->valuePart->add(new ParamDatetime($val));
        return $this;
    }

    public function value(): ValueTool
    {
        return $this->insertCtrl->value();
    }

    public function execute(): Statement
    {
        return $this->insertCtrl->execute();
    }
}
