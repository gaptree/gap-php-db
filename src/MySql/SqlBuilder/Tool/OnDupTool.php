<?php
namespace Gap\Db\MySql\SqlBuilder\Tool;

use Gap\Db\MySql\SqlBuilder\InsertSqlBuilder;
use Gap\Db\MySql\Sql\InsertSql;
use Gap\Db\MySql\Cnn;
use Gap\Db\Pdo\Param\ParamBase;

class OnDupTool extends CondTool
{
    protected $isb;
    protected $cnn;
    protected $insertSql;
    protected $field;

    public function __construct(InsertSqlBuilder $isb, Cnn $cnn, InsertSql $insertSql)
    {
        $this->isb = $isb;
        $this->cnn = $cnn;
        $this->insertSql = $insertSql;
    }

    public function setField(string $field): self
    {
        $this->field = $field;
        return $this;
    }

    public function param(ParamBase $param): InsertSqlBuilder
    {
        $this->insertSql->onDuplicate($this->field, $param);
        return $this->isb;
    }

    public function str(string $str): InsertSqlBuilder
    {
        return $this->param($this->cnn->str($str));
    }

    public function int(int $int): InsertSqlBuilder
    {
        return $this->param($this->cnn->int($int));
    }

    public function bool(bool $bool): InsertSqlBuilder
    {
        return $this->param($this->cnn->bool($bool));
    }

    public function dateTime(\DateTime $dateTime): InsertSqlBuilder
    {
        return $this->param($this->cnn->dateTime($dateTime));
    }

    public function expr(string $expr): InsertSqlBuilder
    {
        return $this->param($this->cnn->expr($expr));
    }
}
