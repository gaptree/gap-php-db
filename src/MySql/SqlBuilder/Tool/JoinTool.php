<?php
namespace Gap\Db\MySql\SqlBuilder\Tool;

use Gap\Db\MySql\Cnn;
use Gap\Db\MySql\Sql\Part\JoinPart;

class JoinTool extends ToolBase
{
    protected $tableTool;
    protected $cnn;
    protected $joinPart;

    public function __construct(TableTool $tableTool, Cnn $cnn, JoinPart $joinPart)
    {
        $this->tableTool = $tableTool;
        $this->cnn = $cnn;
        $this->joinPart = $joinPart;
    }

    public function pre(string $pre): self
    {
        $this->joinPart->pre($pre);
        return $this;
    }

    public function endJoin(): TableTool
    {
        return $this->tableTool;
    }

    public function onCond(): OnCondTool
    {
        $condPart = $this->cnn->cond();
        $this->joinPart->onCond($condPart);

        return new OnCondTool(
            $this,
            $this->cnn,
            $condPart
        );
    }
}
