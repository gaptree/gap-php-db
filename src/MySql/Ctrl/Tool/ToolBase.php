<?php
namespace Gap\Db\MySql\Ctrl\Tool;

use Gap\Db\MySql\Sql\ManipulateSql;
use Gap\Db\MySql\Statement;

abstract class ToolBase
{
    use Support\ToolParamTrait;
    use Support\ToolGroupByTrait;
    use Support\ToolOrderByTrait;

    protected $manipulateSql;

    public function __construct(ManipulateSql $manipulateSql)
    {
        $this->manipulateSql = $manipulateSql;
    }

    public function sql(): string
    {
        return $this->manipulateSql->sql();
    }

    public function offset(int $offset): self
    {
        $this->manipulateSql->offset($offset);
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->manipulateSql->limit($limit);
        return $this;
    }

    public function execute(): Statement
    {
        return $this->manipulateSql->execute();
    }
}
