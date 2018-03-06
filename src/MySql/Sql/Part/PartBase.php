<?php
namespace Gap\Db\MySql\Sql\Part;

abstract class PartBase
{
    abstract public function partSql(): string;

    public function __toString(): string
    {
        return $this->partSql();
    }
}
