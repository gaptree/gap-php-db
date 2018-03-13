<?php
namespace Gap\Db\MySql\SqlBuilder\Tool;

use Gap\Db\MySql\Cnn;
use Gap\Db\MySql\Sql\Part\ExpectPart;
use Gap\Db\Pdo\Param\ParamBase;

class ExpectTool extends ToolBase
{
    use Expect\OperateTrait;

    protected $condTool;
    protected $cnn;
    protected $expectPart;

    protected $operate = '';

    public function __construct(CondTool $condTool, Cnn $cnn, ExpectPart $expectPart)
    {
        $this->condTool = $condTool;
        $this->cnn = $cnn;
        $this->expectPart = $expectPart;
    }

    public function str(string $str): CondTool
    {
        return $this->param($this->cnn->str($str));
    }

    public function int(int $int): CondTool
    {
        return $this->param($this->cnn->int($int));
    }

    public function bool(bool $bool): CondTool
    {
        return $this->param($this->cnn->bool($bool));
    }

    public function dateTime(\DateTime $dateTime): CondTool
    {
        return $this->param($this->cnn->dateTime($dateTime));
    }

    public function expr(string $expr): CondTool
    {
        return $this->param($this->cnn->expr($expr));
    }

    protected function param(ParamBase $param): CondTool
    {
        $this->expectPart->cond($this->operate, $param);
        return $this->condTool;
    }
}
