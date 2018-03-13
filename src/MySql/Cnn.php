<?php
namespace Gap\Db\MySql;

use Gap\Db\CnnInterface;

class Cnn extends \Gap\Db\Pdo\Cnn implements CnnInterface
{
    use CnnSqlTrait;

    public function ssb(): SqlBuilder\SelectSqlBuilder
    {
        return new SqlBuilder\SelectSqlBuilder(
            $this,
            new Sql\SelectSql($this)
        );
    }

    public function dsb(): SqlBuilder\DeleteSqlBuilder
    {
        return new SqlBuilder\DeleteSqlBuilder(
            $this,
            new Sql\DeleteSql($this)
        );
    }

    public function usb(): SqlBuilder\UpdateSqlBuilder
    {
        return new SqlBuilder\UpdateSqlBuilder(
            $this,
            new Sql\UpdateSql($this)
        );
    }

    public function isb(): SqlBuilder\InsertSqlBuilder
    {
        return new SqlBuilder\InsertSqlBuilder(
            $this,
            new Sql\InsertSql($this)
        );
    }
}
