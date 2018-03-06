<?php
namespace Gap\Db\MySql\Ctrl\Tool;

use Gap\Db\MySql\Sql\ManipulateSql;

abstract class ToolBase
{
    use Support\ToolParamTrait;

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

    public function groupBy(string $field, string $sort = ''): self
    {
        $this->manipulateSql->groupBy($field, $sort);
        return $this;
    }

    public function ascGroupBy(string $field): self
    {
        $this->manipulateSql->ascGroupBy($field);
        return $this;
    }

    public function descGroupBy(string $field): self
    {
        $this->manipulateSql->descGroupBy($field);
        return $this;
    }

    public function orderBy(string $field, string $sort = ''): self
    {
        $this->manipulateSql->orderBy($field, $sort);
        return $this;
    }

    public function ascOrderBy(string $field): self
    {
        $this->manipulateSql->ascOrderBy($field);
        return $this;
    }

    public function descOrderBy(string $field): self
    {
        $this->manipulateSql->descOrderBy($field);
        return $this;
    }
}
