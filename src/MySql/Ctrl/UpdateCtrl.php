<?php
namespace Gap\Db\MySql\Ctrl;

use Gap\Db\MySql\Sql\UpdateSql;

class UpdateCtrl extends CtrlBase
{
    protected $updateSql;

    public function __construct(UpdateSql $updateSql)
    {
        $this->updateSql = $updateSql;
    }

    public function update(string ...$tableArr): Tool\TableTool
    {
        $tableTool = new Tool\TableTool($this->updateSql);

        $tablePart = $this->updateSql->getTablePart();
        $tablePart->table(...$tableArr);
        $tableTool->setTablePart($tablePart);
        return $tableTool;
    }
}
