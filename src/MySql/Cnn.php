<?php
namespace Gap\Db\MySql;

class Cnn extends \Gap\Db\Pdo\Cnn
{
    public function select(string ...$selectArr): Ctrl\SelectCtrl
    {
        $selectCtrl = (new Ctrl\SelectCtrl(
            new Sql\SelectSql($this)
        ));
        $selectCtrl->select(...$selectArr);
        return $selectCtrl;
    }

    public function update(string ...$tableArr): Ctrl\UpdateCtrl
    {
    }

    public function delete(string ...$deleteArr): Ctrl\DeleteCtrl
    {
    }

    public function insert(string $into): Ctrl\InsertCtrl
    {
    }
}
