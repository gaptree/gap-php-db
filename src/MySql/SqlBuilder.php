<?php
namespace Gap\Db\MySql;

class SqlBuilder
{
    public function select(string ...$selectArr): Ctrl\SelectCtrl
    {
        return (new Ctrl\SelectCtrl(
            new Sql\SelectSql()
        ))->select(...$selectArr);
        //return (new Sql\SelectSql())->getSelect()->select(...$selectArr);
    }
}
