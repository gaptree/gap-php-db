<?php
namespace Gap\Db\MySql\SqlBuilder;

use Gap\Db\Pdo\Statement;

class SqlBuilderBase
{
    protected $cnn;
    protected $sql;

    public function execute(): Statement
    {
        return $this->sql->execute();
    }

    public function sql(): string
    {
        return $this->sql->sql();
    }
}
