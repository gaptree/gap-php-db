<?php
namespace Gap\Db;

interface CnnInterface
{
    public function beginTransaction(): void;
    public function commit(): void;
    public function rollback(): void;

    //public function exec(string $sql): int;
    //public function prepare(string $sql): StatementInterface;
    //public function query(string $sql): StatementInterface;

    //public function lastInsertId(): string;
    public function zid(): string;
    public function zcode(): string;

    public function select(string ...$fields);
    public function update();
    public function insert(string $table);
    public function delete();
}
