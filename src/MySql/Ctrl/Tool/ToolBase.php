<?php
namespace Gap\Db\MySql\Ctrl\Tool;

use Gap\Db\MySql\Sql\ManipulateSql;

abstract class ToolBase
{
    protected $manipulateSql;

    public function __construct(ManipulateSql $manipulateSql)
    {
        $this->manipulateSql = $manipulateSql;
    }

    public function sql(): string
    {
        return $this->manipulateSql->sql();
    }
}
