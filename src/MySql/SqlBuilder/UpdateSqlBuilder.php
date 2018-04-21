<?php
namespace Gap\Db\MySql\SqlBuilder;

use Gap\Db\MySql\Sql\UpdateSql;
use Gap\Db\MySql\Cnn;
use Gap\Db\Collection;
use Gap\Db\Contract\SqlBuilder\UpdateSqlBuilderInterface;

class UpdateSqlBuilder extends ManipulateSqlBuilder implements UpdateSqlBuilderInterface
{
    protected $setTool;

    public function __construct(Cnn $cnn, UpdateSql $updateSql)
    {
        $this->cnn =$cnn;
        $this->sql = $updateSql;
        $this->setTool = new Tool\SetTool($this, $this->cnn, $updateSql);
    }

    public function update(string ...$tableArr): Tool\TableTool
    {
        return $this->table(...$tableArr);
    }

    public function set(string $field): Tool\SetTool
    {
        $this->setTool->setField($field);
        return $this->setTool;
    }
}
