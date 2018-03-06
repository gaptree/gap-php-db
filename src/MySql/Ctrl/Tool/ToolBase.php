<?php
namespace Gap\Db\MySql\Ctrl\Tool;

use Gap\Db\MySql\Sql\ManipulateSql;
use Gap\Db\MySql\RowCollection;

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

    public function fetch(string $class)
    {
        return $this->manipulateSql->fetch($class);
    }

    public function list(string $class): RowCollection
    {
        return $this->manipulateSql->list($class);
    }

    public function fetchAssoc(): array
    {
        return $this->manipulateSql->fetchAssoc();
    }

    public function listAssoc(): array
    {
        return $this->manipulateSql->listAssoc();
    }
}
