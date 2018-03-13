<?php
namespace Gap\Db\MySql\SqlBuilder\Tool;

use Gap\Db\MySql\SqlBuilder\UpdateSqlBuilder;
use Gap\Db\MySql\Sql\UpdateSql;
use Gap\Db\MySql\Cnn;
use Gap\Db\Pdo\Param\ParamBase;

class SetTool extends CondTool
{
    protected $usb;
    protected $cnn;
    protected $updateSql;
    protected $field;

    public function __construct(UpdateSqlBuilder $usb, Cnn $cnn, UpdateSql $updateSql)
    {
        $this->usb = $usb;
        $this->cnn = $cnn;
        $this->updateSql = $updateSql;
    }

    public function setField(string $field): self
    {
        $this->field = $field;
        return $this;
    }

    public function param(ParamBase $param): UpdateSqlBuilder
    {
        $this->updateSql->set($this->field, $param);
        return $this->usb;
    }

    public function str(string $str): UpdateSqlBuilder
    {
        return $this->param($this->cnn->str($str));
    }

    public function int(int $int): UpdateSqlBuilder
    {
        return $this->param($this->cnn->int($int));
    }

    public function bool(bool $bool): UpdateSqlBuilder
    {
        return $this->param($this->cnn->bool($bool));
    }

    public function dateTime(\DateTime $dateTime): UpdateSqlBuilder
    {
        return $this->param($this->cnn->dateTime($dateTime));
    }

    public function expr(string $expr): UpdateSqlBuilder
    {
        return $this->param($this->cnn->expr($expr));
    }
}
