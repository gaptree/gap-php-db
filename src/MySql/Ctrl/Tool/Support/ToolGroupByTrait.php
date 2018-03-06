<?php
namespace Gap\Db\MySql\Ctrl\Tool\Support;

trait ToolGroupByTrait
{
    public function groupBy(string $field, string $sort = ''): self
    {
        $this->manipulateSql->groupBy($field, $sort);
        return $this;
    }

    public function ascGroupBy(string $field): self
    {
        return $this->groupBy($field, 'ASC');
    }

    public function descGroupBy(string $field): self
    {
        return $this->groupBy($field, 'DESC');
    }
}
