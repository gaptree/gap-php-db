<?php
namespace Gap\Db;

interface StatementInterface
{
    //public function bindValue(string $param, string $value, string $typeName = 'str');
    //public function bindParam(string $param, string $value, string $typeName = 'str');
    //public function execute(array $params): void;
    public function execute(): void;
    public function fetch();
    public function fetchAll();
    public function rowCount();
}
