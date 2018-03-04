<?php
namespace Gap\Db\MySql\Sql;

abstract class SqlBase
{
    abstract public function sql(): string;
}
