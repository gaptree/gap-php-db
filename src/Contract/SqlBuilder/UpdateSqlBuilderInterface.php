<?php
namespace Gap\Db\Contract\SqlBuilder;

interface UpdateSqlBuilderInterface
{
    public function update(string ...$tableArr);
    public function set(string $field);
}
