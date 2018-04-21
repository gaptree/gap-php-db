<?php
namespace Gap\Db\Contract\SqlBuilder;

interface SelectSqlBuilderInterface
{
    public function select(string ...$selectArr);
    public function from(string ...$tableArr);
    public function fetch(string $class);
    public function fetchAssoc(): array;
    public function list(string $class);
    public function listAssoc();
    public function count();
}
