<?php
namespace Gap\Db\MySql\Ctrl\Tool;

use Gap\Db\MySql\Sql\Part\ExpectPart;
use Gap\Db\MySql\Param\ParamStr;
use Gap\Db\MySql\Param\ParamInt;

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

    public function greater($val): WhereTool
    {
        $param = is_int($val) ? new ParamInt($val) : new ParamStr($val);
        $this->expectPart->cond('>', $param);
        return $this->whereTool;
    }
}
