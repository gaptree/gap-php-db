<?php
namespace Gap\Db\MySql\Ctrl\Tool;

use Gap\Db\MySql\Sql\Part\ExpectPart;

class ExpectTool extends ToolBase
{
    protected $whereTool;
    protected $expectPart;

    public function setWhereTool(WhereTool $whereTool): void
    {
        $this->whereTool = $whereTool;
    }

    public function setExpectPart(ExpectPart $expectPart): void
    {
        $this->expectPart = $expectPart;
    }

    public function beExpr(string $expr): WhereTool
    {
        $this->expectPart->expr('=', $expr);
        return $this->whereTool;
    }

    public function beStr(string $val): WhereTool
    {
        $this->expectPart->cond('=', $this->paramStr($val));
        return $this->whereTool;
    }

    public function beInt(int $val): WhereTool
    {
        $this->expectPart->cond('=', $this->paramInt($val));
        return $this->whereTool;
    }

    public function beDateTime(\DateTime $dateTime): WhereTool
    {
        $this->expectPart->cond('=', $this->paramDateTime($dateTime));
        return $this->whereTool;
    }

    public function greater($val): WhereTool
    {
        $this->expectPart->cond('>', $this->paramNumber($val));
        return $this->whereTool;
    }
}
