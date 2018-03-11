<?php
namespace Gap\Db\MySql\Ctrl;

use Gap\Db\MySql\Sql\InsertSql;
use Gap\Db\Pdo\Statement;

class InsertCtrl extends CtrlBase
{
    protected $insertSql;

    public function __construct(InsertSql $insertSql)
    {
        $this->insertSql = $insertSql;
    }

    public function into(string $into): self
    {
        $this->insertSql->into($into);
        return $this;
    }

    public function field(string ...$field): self
    {
        $this->insertSql->field(...$field);
        return $this;
    }

    public function value(): Tool\ValueTool
    {
        return new Tool\ValueTool(
            $this,
            $this->insertSql->getValuePart()
        );
    }

    public function execute(): Statement
    {
        return $this->insertSql->execute();
    }

    public function getInsertSql(): InsertSql
    {
        return $this->insertSql;
    }
}
