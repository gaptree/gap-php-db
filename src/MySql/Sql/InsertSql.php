<?php
namespace Gap\Db\MySql\Sql;

class InsertSql extends SqlBase
{
    protected $fieldArr = [];
    protected $valuePartArr = [];
    protected $into;

    public function field(string ...$fieldArr): self
    {
        $this->fieldArr = $fieldArr;
        return $this;
    }

    public function value(Part\ValuePart $valuePart): self
    {
        $this->valuePartArr[] = $valuePart;
        return $this;
    }

    public function into(string $into): self
    {
        $this->into = $into;
        return $this;
    }

    public function sql(): string
    {
        return 'INSERT INTO ' . $this->into
            . ' (' . implode(', ', $this->fieldArr) . ')'
            . ' VALUES '
            . implode(', ', $this->valuePartArr);
    }
}
