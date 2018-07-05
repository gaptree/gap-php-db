<?php
namespace Gap\Db\MySql\SqlBuilder;

use Gap\Db\MySql\Sql\InsertSql;
use Gap\Db\MySql\Cnn;
use Gap\Db\Collection;
use Gap\Db\Contract\SqlBuilder\InsertSqlBuilderInterface;

class InsertSqlBuilder extends ManipulateSqlBuilder implements InsertSqlBuilderInterface
{
    private $valueTool;
    private $onDupTool;

    public function __construct(Cnn $cnn, InsertSql $insertSql)
    {
        $this->cnn =$cnn;
        $this->sql = $insertSql;
        $this->valueTool = new Tool\ValueTool($this, $this->cnn);
        $this->onDupTool = new Tool\OnDupTool($this, $this->cnn, $insertSql);
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

    public function onDuplicate(string $field): Tool\OnDupTool
    {
        $this->onDupTool->setField($field);
        return $this->onDupTool;
    }
}
