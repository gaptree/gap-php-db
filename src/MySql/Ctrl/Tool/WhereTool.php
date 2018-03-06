<?php
namespace Gap\Db\MySql\Ctrl\Tool;

use Gap\Db\MySql\Sql\Part\WherePart;

class WhereTool extends ToolBase
{
    protected $wherePart;
    protected $parent;

    public function setParent(WhereTool $parent): void
    {
        $this->parent = $parent;
    }

    public function end(): WhereTool
    {
        return $this->parent;
    }

    public function setWherePart(WherePart $wherePart): void
    {
        $this->wherePart = $wherePart;
    }

    public function expect(string $field, string $pre = ''): ExpectTool
    {
        $expectTool = new ExpectTool($this->manipulateSql);
        $expectTool->setExpectPart($this->wherePart->getExpectPart($field, $pre));
        $expectTool->setWhereTool($this);

        return $expectTool;
    }

    public function andExpect(string $field): ExpectTool
    {
        return $this->expect($field, 'AND');
    }

    public function orExpect(string $field): ExpectTool
    {
        return $this->expect($field, 'OR');
    }

    public function group(string $pre = ''): WhereTool
    {
        $groupTool = new WhereTool($this->manipulateSql);
        $groupTool->setWherePart($this->wherePart->getGroupPart($pre)->pack());
        $groupTool->setParent($this);
        return $groupTool;
    }

    public function andGroup(): WhereTool
    {
        return $this->group('AND');
    }

    public function orGroup(): WhereTool
    {
        return $this->group('OR');
    }

    public function where(): WhereTool
    {
    }
}
