<?php
namespace Gap\Db\MySql;

class Cnn extends \Gap\Db\Pdo\Cnn
{
    public function select(string ...$selectArr): Ctrl\SelectCtrl
    {
        $this->currentSql = new Sql\SelectSql($this);
        $this->currentCtrl = new Ctrl\SelectCtrl($this->currentSql);
        $this->currentCtrl->select(...$selectArr);
        return $this->currentCtrl;
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
