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
    
    public function set(string $field): SetTool
    {
        $setTool = new SetTool($this->manipulateSql);
        $setTool->setSetPart($this->manipulateSql->getSetPart($field));
        return $setTool;
    }
}
