<?php
namespace Gap\Db\MySql\SqlBuilder;

class ManipulateSqlBuilder extends SqlBuilderBase
{
    use Select\FetchTrait;

    public function where(): Tool\WhereCondTool
    {
        $condPart = $this->cnn->cond();
        $this->sql->where($condPart);
        return new Tool\WhereCondTool($this, $this->cnn, $condPart);
    }

    public function set(string $field): Tool\SetTool
    {
        if (empty($field)) {
            throw new \Exception('set empty field');
        }
    }

    public function limit(int $limit): self
    {
        $this->sql->limit($limit);
        return $this;
    }

    public function offset(int $offset): self
    {
        $this->sql->offset($offset);
        return $this;
    }

    public function groupBy(string $field, $sort = ''): self
    {
        $this->sql->groupBy($field, $sort);
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

    public function orderBy(string $field, $sort = ''): self
    {
        $this->sql->orderBy($field, $sort);
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

    public function table(string ...$tableArr): Tool\TableTool
    {
        $tablePart = $this->cnn->table(...$tableArr);
        $this->sql->table($tablePart);
        return new Tool\TableTool($this, $this->cnn, $tablePart);
    }
}
