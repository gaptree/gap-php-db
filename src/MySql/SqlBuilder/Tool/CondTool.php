<?php
namespace Gap\Db\MySql\SqlBuilder\Tool;

use Gap\Db\MySql\SqlBuilder\ManipulateSqlBuilder;

class CondTool extends ToolBase
{
    protected $cnn;
    protected $condPart;

    public function end()
    {
    }

    public function endJoin()
    {
    }

    public function endGroup()
    {
    }
    /*
    protected $msb;
    public function __construct(ManipulateSqlBuilder $msb, Cnn $cnn, CondPart $condPart)
    {
        $this->msb = $msb;
    }
    */

    public function expect(string $field, string $pre = ''): ExpectTool
    {
        return new ExpectTool(
            $this,
            $this->cnn,
            $this->condPart->expect($field, $pre)
        );
    }

    public function andExpect(string $field): ExpectTool
    {
        return $this->expect($field, 'AND');
    }

    public function orExpect(string $field): ExpectTool
    {
        return $this->expect($field, 'OR');
    }

    public function group(string $pre = ''): GroupCondTool
    {
        $group = $this->cnn->cond();
        $group->pre($pre);
        $this->condPart->group($group);
        return new GroupCondTool(
            $this,
            $this->cnn,
            $group
        );
    }

    public function andGroup(): GroupCondTool
    {
        return $this->group('AND');
    }

    public function orGroup(): GroupCondTool
    {
        return $this->group('OR');
    }
}
