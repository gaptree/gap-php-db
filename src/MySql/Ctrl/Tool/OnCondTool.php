<?php
namespace Gap\Db\MySql\Ctrl\Tool;

class OnCondTool extends WhereTool
{
    public function where(): WhereTool
    {
        $whereTool = new WhereTool($this->manipulateSql);
        $whereTool->setWherePart($this->manipulateSql->getWherePart());
        return $whereTool;
    }
}
