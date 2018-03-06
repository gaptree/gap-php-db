<?php
namespace Gap\Db\MySql\Ctrl;

use Gap\Db\MySql\Sql\SelectSql;

class SelectCtrl
{
    protected $selectSql;

    public function __construct(SelectSql $selectSql)
    {
        $this->selectSql = $selectSql;
    }

    public function select(string ...$selectArr): self
    {
        $this->selectSql->select(...$selectArr);
        return $this;
    }

    public function from(string ...$tableArr): Tool\TableTool
    {
        $tableTool = new Tool\TableTool($this->selectSql);

        $tablePart = $this->selectSql->getTablePart();
        $tablePart->table(...$tableArr);
        $tableTool->setTablePart($tablePart);
        //$tableTool->table(...$tableArr);
        return $tableTool;
    }
}
