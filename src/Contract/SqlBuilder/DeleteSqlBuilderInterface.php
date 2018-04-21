<?php
namespace Gap\Db\Contract\SqlBuilder;

interface DeleteSqlBuilderInterface
{
    public function delete(string ...$deleteArr);
    public function from(string ...$tableArr);
}
