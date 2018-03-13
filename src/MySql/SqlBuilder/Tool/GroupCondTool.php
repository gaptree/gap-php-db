<?php
namespace Gap\Db\MySql\SqlBuilder\Tool;

use Gap\Db\MySql\Cnn;
use Gap\Db\MySql\Sql\Part\CondPart;

class GroupCondTool extends CondTool
{
    protected $condTool;

    public function __construct(CondTool $condTool, Cnn $cnn, CondPart $condPart)
    {
        $this->condTool = $condTool;
        $this->cnn = $cnn;
        $this->condPart = $condPart;
    }

    public function endGroup(): CondTool
    {
        return $this->condTool;
    }
}
