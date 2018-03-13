<?php
namespace Gap\Db\MySql\SqlBuilder;

use Gap\Db\MySql\Sql\DeleteSql;
use Gap\Db\MySql\Cnn;
use Gap\Db\Collection;

class DeleteSqlBuilder extends ManipulateSqlBuilder
{
    public function __construct(Cnn $cnn, DeleteSql $deleteSql)
    {
        $this->cnn =$cnn;
        $this->sql = $deleteSql;
    }

    public function from(string ...$tableArr): Tool\TableTool
    {
        return $this->table(...$tableArr);
    }

    public function delete(string ...$deleteArr): self
    {
        $this->sql->delete(...$deleteArr);
        return $this;
    }
}
