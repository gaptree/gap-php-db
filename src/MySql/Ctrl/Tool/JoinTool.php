<?php
namespace Gap\Db\MySql\Ctrl\Tool;

use Gap\Db\MySql\Sql\Part\JoinPart;

class JoinTool extends ToolBase
{
    protected $joinPart;

    public function setJoinPart(JoinPart $joinPart): void
    {
        $this->joinPart = $joinPart;
    }

    public function onCond(): OnCondTool
    {
        $onCondTool = new OnCondTool($this->manipulateSql);
        $onCondTool->setWherePart($this->joinPart->getWherePart());
        return $onCondTool;
    }
}
