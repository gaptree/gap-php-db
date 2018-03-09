<?php
namespace Gap\Db\MySql\Ctrl\Tool;

use Gap\Db\MySql\Sql\Part\SetPart;

class SetTool extends ToolBase
{
    protected $setPart;

    public function setSetPart(SetPart $setPart): void
    {
        $this->setPart = $setPart;
    }

    public function beExpr(string $expr): self
    {
        $this->setPart->beExpr($expr);
        return $this;
    }

    public function beStr(string $val): self
    {
        $this->setPart->beParam($this->paramStr($val));
        return $this;
    }

    public function beInt(int $val): self
    {
        $this->setPart->beParam($this->paramInt($val));
        return $this;
    }

    public function beDateTime(\DateTime $dateTime): self
    {
        $this->setPart->beParam($this->paramDateTime($dateTime));
        return $this;
    }

    public function set(string $field): SetTool
    {
        $setTool = new SetTool($this->manipulateSql);
        $setTool->setSetPart($this->manipulateSql->getSetPart($field));
        return $setTool;
    }

    public function where(): WhereTool
    {
        $whereTool = new WhereTool($this->manipulateSql);
        $whereTool->setWherePart($this->manipulateSql->getWherePart());
        return $whereTool;
    }
}
