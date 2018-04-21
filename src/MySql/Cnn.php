<?php
namespace Gap\Db\MySql;

use Gap\Db\Contract\CnnInterface;
use Gap\Db\Contract\SqlBuilder\SelectSqlBuilderInterface;
use Gap\Db\Contract\SqlBuilder\DeleteSqlBuilderInterface;
use Gap\Db\Contract\SqlBuilder\UpdateSqlBuilderInterface;
use Gap\Db\Contract\SqlBuilder\InsertSqlBuilderInterface;

class Cnn extends \Gap\Db\Pdo\Cnn implements CnnInterface
{
    use CnnSqlTrait;

    public function ssb(): SelectSqlBuilderInterface
    {
        return new SqlBuilder\SelectSqlBuilder(
            $this,
            new Sql\SelectSql($this)
        );
    }

    public function dsb(): DeleteSqlBuilderInterface
    {
        return new SqlBuilder\DeleteSqlBuilder(
            $this,
            new Sql\DeleteSql($this)
        );
    }

    public function usb(): UpdateSqlBuilderInterface
    {
        return new SqlBuilder\UpdateSqlBuilder(
            $this,
            new Sql\UpdateSql($this)
        );
    }

    public function isb(): InsertSqlBuilderInterface
    {
        return new SqlBuilder\InsertSqlBuilder(
            $this,
            new Sql\InsertSql($this)
        );
    }
}
