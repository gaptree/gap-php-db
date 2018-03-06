<?php
namespace Gap\Db\MySql\Ctrl\Tool\Support;

trait ToolOrderByTrait
{
    public function orderBy(string $field, string $sort = ''): self
    {
        $this->manipulateSql->orderBy($field, $sort);
        return $this;
    }

    public function ascOrderBy(string $field): self
    {
        return $this->orderBy($field, 'ASC');
    }

    public function descOrderBy(string $field): self
    {
        return $this->orderBy($field, 'DESC');
    }
}
