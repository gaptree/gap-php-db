<?php
namespace Gap\Db\Contract\SqlBuilder;

interface InsertSqlBuilderInterface
{
    public function insert(string $into);
    public function field(string ...$fieldArr);
    public function value();
}
