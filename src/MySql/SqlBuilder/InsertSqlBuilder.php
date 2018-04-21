<?php
namespace Gap\Db\MySql\SqlBuilder;

use Gap\Db\MySql\Sql\InsertSql;
use Gap\Db\MySql\Cnn;
use Gap\Db\Collection;
use Gap\Db\Contract\SqlBuilder\InsertSqlBuilderInterface;

class InsertSqlBuilder extends ManipulateSqlBuilder implements InsertSqlBuilderInterface
{
    protected $valueTool;

    public function __construct(Cnn $cnn, InsertSql $insertSql)
    {
        $this->cnn =$cnn;
        $this->sql = $insertSql;
        $this->valueTool = new Tool\ValueTool($this, $this->cnn);
    }

    public function insert(string $into): self
    {
        $this->sql->into($into);
        return $this;
    }

    public function field(string ...$field): self
    {
        $this->sql->field(...$field);
        return $this;
    }

    public function value(): Tool\ValueTool
    {
        $valuePart = $this->cnn->value();
        $this->sql->value($valuePart);
        $this->valueTool->setValuePart($valuePart);
        return $this->valueTool;
    }
}
