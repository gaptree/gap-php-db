<?php
namespace Gap\Db\MySql\SqlBuilder\Tool;

use Gap\Db\MySql\SqlBuilder\InsertSqlBuilder;
use Gap\Db\MySql\Sql\Part\ValuePart;
use Gap\Db\MySql\Cnn;
use Gap\Db\Pdo\Param\ParamBase;

class ValueTool extends ToolBase
{
    protected $isb;
    protected $cnn;
    protected $valuePart;

    public function __construct(InsertSqlBuilder $isb, Cnn $cnn)
    {
        $this->isb = $isb;
        $this->cnn = $cnn;
    }

    public function setValuePart(ValuePart $valuePart): self
    {
        $this->valuePart = $valuePart;
        return $this;
    }

    public function end():InsertSqlBuilder
    {
        return $this->isb;
    }

    protected function add(ParamBase $param): self
    {
        $this->valuePart->add($param);
        return $this;
    }

    public function addStr(string $str): self
    {
        return $this->add($this->cnn->str($str));
    }

    public function addInt(int $int): self
    {
        return $this->add($this->cnn->int($int));
    }

    public function addBool(bool $bool): self
    {
        return $this->add($this->cnn->bool($bool));
    }

    public function addDateTime(\DateTime $dateTime): self
    {
        return $this->add($this->cnn->dateTime($dateTime));
    }

    public function addExpr(string $expr): self
    {
        return $this->add($this->cnn->expr($expr));
    }
}
