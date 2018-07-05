<?php
namespace Gap\Db\MySql\Sql;

use Gap\Db\Pdo\Param\ParamBase;

class InsertSql extends SqlBase
{
    private $fieldArr = [];
    private $valuePartArr = [];
    private $onDupPartArr = [];
    private $into;

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

    public function onDuplicate(string $field, ParamBase $param): self
    {
        $setPart = new Part\SetPart($field, $param);
        $this->onDupPartArr[] = $setPart;
        return $this;
    }

    public function into(string $into): self
    {
        $this->into = $into;
        return $this;
    }

    public function sql(): string
    {
        $sql = 'INSERT INTO ' . $this->into
            . ' (' . implode(', ', $this->fieldArr) . ')'
            . ' VALUES '
            . implode(', ', $this->valuePartArr);

        if ($this->onDupPartArr) {
            $sql .= ' ON DUPLICATE KEY UPDATE '
                . implode(', ', $this->onDupPartArr);
        }
        return $sql;
    }
}
