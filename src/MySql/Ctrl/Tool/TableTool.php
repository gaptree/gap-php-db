<?php
namespace Gap\Db\MySql\Ctrl\Tool;

use Gap\Db\MySql\Sql\Part\TablePart;
use Gap\Db\MySql\Sql\Part\JoinPart;

class TableTool extends ToolBase
{
    protected $tablePart;

    public function setTablePart(TablePart $tablePart): void
    {
        $this->tablePart = $tablePart;
    }

    public function table(string ...$tableArr): self
    {
        $this->tablePart->table(...$tableArr);
        return $this;
    }

    protected function makeJoinTool(JoinPart $joinPart): JoinTool
    {
        $joinTool = new JoinTool($this->manipulateSql);
        $joinTool->setJoinPart($joinPart);
        return $joinTool;
    }

    protected function makeJoinPart(string ...$tableArr): JoinPart
    {
        $joinPart = $this->tablePart->getJoinPart();
        $joinPart->table(...$tableArr);
        return $joinPart;
    }

    public function join(string ...$tableArr): JoinTool
    {
        $joinPart = $this->makeJoinPart(...$tableArr);
        return $this->makeJoinTool($joinPart);
    }

    public function leftJoin(string ...$tableArr): JoinTool
    {
        $joinPart = $this->makeJoinPart(...$tableArr);
        $joinPart->left();
        return $this->makeJoinTool($joinPart);
    }

    public function rightJoin(string ...$tableArr): JoinTool
    {
        $joinPart = $this->makeJoinPart(...$tableArr);
        $joinPart->right();
        return $this->makeJoinTool($joinPart);
    }

    public function innerJoin(string ...$tableArr): JoinTool
    {
        $joinPart = $this->makeJoinPart(...$tableArr);
        $joinPart->inner();
        return $this->makeJoinTool($joinPart);
    }

    public function outerJoin(string ...$tableArr): JoinTool
    {
        $joinPart = $this->makeJoinPart(...$tableArr);
        $joinPart->outer();
        return $this->makeJoinTool($joinPart);
    }

    public function where(string $field): WhereCtrl
    {
        return new WhereCtrl($this->manipulateSql);
    }
}
