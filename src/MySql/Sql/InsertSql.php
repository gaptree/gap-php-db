<?php
namespace Gap\Db\MySql\Sql;

class InsertSql extends SqlBase
{
    protected $fieldArr = [];
    protected $valuePartArr = [];
    protected $into;

    public function field(string ...$fieldArr): void
    {
        $this->fieldArr = $fieldArr;
    }

    public function getValuePart(): Part\ValuePart
    {
        $valuePart = new Part\ValuePart();
        $this->valuePartArr[] = $valuePart;
        return $valuePart;
    }

    public function into(string $into): void
    {
        $this->into = $into;
    }

    public function sql(): string
    {
        return 'INSERT INTO ' . $this->into
            . ' (' . implode(', ', $this->fieldArr) . ')'
            . ' VALUES '
            . implode(', ', $this->valuePartArr);
    }
}
