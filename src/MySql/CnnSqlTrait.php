<?php
namespace Gap\Db\MySql;

trait CnnSqlTrait
{
    public function select(string ...$selectArr): Sql\SelectSql
    {
        return (new Sql\SelectSql($this))->select(...$selectArr);
    }

    public function update(Sql\Part\TablePart $tablePart): Sql\UpdateSql
    {
        return (new Sql\UpdateSql($this))->update($tablePart);
    }

    public function delete(string ...$deleteArr): Sql\DeleteSql
    {
        return (new Sql\DeleteSql($this))->delete(...$deleteArr);
    }

    public function insert(string $into): Sql\InsertSql
    {
        return (new Sql\InsertSql($this))->into($into);
    }

    public function table(string ...$tableArr): Sql\Part\TablePart
    {
        return new Sql\Part\TablePart(...$tableArr);
    }

    public function cond(): Sql\Part\CondPart
    {
        return new Sql\Part\CondPart();
    }

    public function value(): Sql\Part\ValuePart
    {
        return new Sql\Part\ValuePart();
    }
}
