<?php
namespace Gap\Db\MySql\Ctrl\Tool;

use Gap\Db\MySql\Sql\Part\WherePart;

class WhereTool extends ToolBase
{
    protected $wherePart;

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

    public function where(): WhereTool
    {
    }
}
