<?php
namespace Gap\Db\MySql\SqlBuilder\Tool;

use Gap\Db\MySql\Cnn;
use Gap\Db\MySql\Sql\Part\CondPart;

class OnCondTool extends CondTool
{
    protected $joinTool;

    public function __construct(JoinTool $joinTool, Cnn $cnn, CondPart $condPart)
    {
        $this->joinTool = $joinTool;
        $this->cnn = $cnn;
        $this->condPart = $condPart;
    }

    public function endJoin(): TableTool
    {
        return $this->joinTool->endJoin();
    }
}
