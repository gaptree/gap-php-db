<?php
namespace Gap\Db\MySql\Ctrl;

use Gap\Db\MySql\Sql\DeleteSql;

class DeleteCtrl extends CtrlBase
{
    protected $deleteSql;

    public function __construct(DeleteSql $deleteSql)
    {
        $this->deleteSql = $deleteSql;
    }

    public function delete(string ...$deleteArr): self
    {
        $this->deleteSql->delete(...$deleteArr);
        return $this;
    }

    public function from(string ...$tableArr): Tool\TableTool
    {
        $tableTool = new Tool\TableTool($this->deleteSql);

        $tablePart = $this->deleteSql->getTablePart();
        $tablePart->table(...$tableArr);
        $tableTool->setTablePart($tablePart);
        //$tableTool->table(...$tableArr);
        return $tableTool;
    }
}
