<?php
namespace Gap\Db\MySql\Sql;

use Gap\Db\MySql\Cnn;
use Gap\Db\Pdo\Param\ParamStr;
use Gap\Db\Pdo\Param\ParamInt;
use Gap\Db\Pdo\Param\ParamBool;
use Gap\Db\Pdo\Param\ParamDateTime;

use Gap\Db\Pdo\Statement;

abstract class SqlBase
{
    protected $cnn;

    public function __construct(Cnn $cnn)
    {
        $this->cnn = $cnn;
    }

    /*
    public function execute(): Statement
    {
        $stmt = $this->cnn->prepare($this->sql());
        $stmt->bindParam(...$this->paramArr);
        $stmt->execute();
        return $stmt;
    }
    */

    public function query(): Statement
    {
        return $this->cnn->query($this->sql());
    }

    public function execute(): Statement
    {
        return $this->query();
    }

    abstract public function sql(): string;
}
