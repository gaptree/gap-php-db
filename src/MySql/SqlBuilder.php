<?php
namespace Gap\Db\MySql;

class SqlBuilder
{
    public function select(string ...$selectArr): Sql\Select\Base
    {
        return (new Sql\SelectSql())->getSelect()->select(...$selectArr);
    }
}
